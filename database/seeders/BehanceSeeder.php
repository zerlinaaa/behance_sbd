<?php

namespace Database\Seeders;

use App\Models\{User, Project, ProjectImage, Category, Comment};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BehanceSeeder extends Seeder
{
    public function run(): void
    {
        // ─── 1. USERS (100 user + 1 admin) ───────────────────────────
        $this->command->info('Seeding users...');
        User::factory()->admin()->create();
        $users = User::factory(100)->create();

        // ─── 2. PROJECTS (500 project, rata-rata 5 per user) ──────────
        $this->command->info('Seeding projects...');
        $projects = collect();
        $users->each(function($user) use (&$projects) {
            $count = rand(3, 8);
            $newProjects = Project::factory($count)->create([
                'user_id' => $user->id
            ]);
            $projects = $projects->merge($newProjects);
        });
        $this->command->info("Created {$projects->count()} projects");

        // ─── 3. PROJECT IMAGES (3 gambar per project = ~1500 baris) ──
        $this->command->info('Seeding project images...');
        $projects->each(function($project) {
            $count = rand(2, 6);
            ProjectImage::factory($count)->create([
                'project_id' => $project->id
            ]);
        });

        // ─── 4. PROJECT CATEGORIES (N:M, tiap project 1-3 kategori) ──
        $this->command->info('Seeding project categories...');
        $categoryIds = Category::pluck('id')->toArray();

        $projects->each(function($project) use ($categoryIds) {
            $picked = array_rand(
                array_flip($categoryIds),
                rand(1, 3)
            );
            // sync() aman dari duplikat (UNIQUE constraint)
            $project->categories()->sync((array)$picked);
        });

        // ─── 5. COMMENTS (600 komentar + reply) ─────────────────────
        $this->command->info('Seeding comments...');
        $userIds    = $users->pluck('id')->toArray();
        $projectIds = $projects->pluck('id')->toArray();

        // Komentar utama (500 baris)
        $parentComments = Comment::factory(500)->create([
            'project_id' => fn() => $projectIds[array_rand($projectIds)],
            'user_id'    => fn() => $userIds[array_rand($userIds)],
            'parent_id'  => null,
        ]);

        // Reply komentar (100 baris, 20% dari total)
        $parentIds = $parentComments->pluck('id')->toArray();
        Comment::factory(100)->create([
            'project_id' => fn() => $projectIds[array_rand($projectIds)],
            'user_id'    => fn() => $userIds[array_rand($userIds)],
            'parent_id'  => fn() => $parentIds[array_rand($parentIds)],
        ]);

        // ─── 6. LIKES (800 baris, tidak duplikat) ────────────────────
        $this->command->info('Seeding likes...');
        $likesPairs = [];
        $attempts   = 0;

        while (count($likesPairs) < 800 && $attempts < 5000) {
            $uid = $userIds[array_rand($userIds)];
            $pid = $projectIds[array_rand($projectIds)];
            $key = "{$uid}-{$pid}";

            if (!isset($likesPairs[$key])) {
                $likesPairs[$key] = [
                    'project_id' => $pid,
                    'user_id'    => $uid,
                    'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
                    'updated_at' => now(),
                ];
            }
            $attempts++;
        }

        // Bulk insert (jauh lebih cepat dari loop satu-satu)
        DB::table('likes')->insert(array_values($likesPairs));

        // ─── 7. FOLLOWS (400 baris, tidak follow diri sendiri) ───────
        $this->command->info('Seeding follows...');
        $followPairs = [];
        $attempts    = 0;

        while (count($followPairs) < 400 && $attempts < 3000) {
            $followerId  = $userIds[array_rand($userIds)];
            $followingId = $userIds[array_rand($userIds)];
            $key         = "{$followerId}-{$followingId}";

            // Tidak boleh follow diri sendiri, tidak boleh duplikat
            if ($followerId !== $followingId && !isset($followPairs[$key])) {
                $followPairs[$key] = [
                    'follower_id'  => $followerId,
                    'following_id' => $followingId,
                    'created_at'   => fake()->dateTimeBetween('-2 years', 'now'),
                    'updated_at'   => now(),
                ];
            }
            $attempts++;
        }
        DB::table('follows')->insert(array_values($followPairs));

        // ─── 8. BOOKMARKS (500 baris, tidak duplikat) ────────────────
        $this->command->info('Seeding bookmarks...');
        $bmPairs  = [];
        $attempts = 0;
        $collections = ['Saved', 'Inspiration', 'Work in Progress', 'Favorites'];

        while (count($bmPairs) < 500 && $attempts < 4000) {
            $uid = $userIds[array_rand($userIds)];
            $pid = $projectIds[array_rand($projectIds)];
            $key = "{$uid}-{$pid}";

            if (!isset($bmPairs[$key])) {
                $bmPairs[$key] = [
                    'user_id'         => $uid,
                    'project_id'      => $pid,
                    'collection_name' => $collections[array_rand($collections)],
                    'created_at'      => fake()->dateTimeBetween('-1 year', 'now'),
                    'updated_at'      => now(),
                ];
            }
            $attempts++;
        }
        DB::table('bookmarks')->insert(array_values($bmPairs));

        // ─── Update counter denormalisasi ────────────────────────────
        $this->command->info('Updating counters...');
        DB::statement('
            UPDATE projects p SET
                likes_count    = (SELECT COUNT(*) FROM likes    WHERE project_id = p.id),
                comments_count = (SELECT COUNT(*) FROM comments WHERE project_id = p.id)
        ');
        DB::statement('
            UPDATE users u SET
                followers_count = (SELECT COUNT(*) FROM follows WHERE following_id = u.id),
                following_count = (SELECT COUNT(*) FROM follows WHERE follower_id  = u.id)
        ');

        $this->command->info('✓ Seeding selesai!');
    }
}