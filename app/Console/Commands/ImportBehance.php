<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\{User, Project, ProjectImage, Category};

class ImportBehance extends Command
{
    protected $signature   = 'import:behance {--file=behance_data.json}';
    protected $description = 'Import data scraping Behance dari JSON ke database';

    public function handle(): void
    {
        $file = storage_path('app/' . $this->option('file'));

        if (!file_exists($file)) {
            $this->error("File tidak ditemukan: {$file}");
            $this->line("Copy behance_data.json ke folder storage/app/");
            return;
        }

        $this->info("Membaca {$file}...");
        $data = json_decode(file_get_contents($file), true);

        if (!$data || !is_array($data)) {
            $this->error("File JSON tidak valid atau kosong.");
            return;
        }

        $this->info("Total data: " . count($data) . " project\n");

        // ── Ambil semua kategori yang ada ──────────────────
        $categories = Category::pluck('id', 'name')->toArray();
        // Normalisasi key ke lowercase untuk matching
        $catLower = array_combine(
            array_map('strtolower', array_keys($categories)),
            array_values($categories)
        );

        $bar = $this->output->createProgressBar(count($data));
        $bar->start();

        $totalProject  = 0;
        $totalUser     = 0;
        $totalImage    = 0;
        $gagal         = 0;

        DB::beginTransaction();
        try {
            foreach ($data as $item) {
                // ── 1. Upsert User ─────────────────────────────
                $userData = $item['user'] ?? [];
                $username = Str::slug($userData['username'] ?? 'user_' . Str::random(6));
                $username = substr($username, 0, 50);

                $user = User::firstOrCreate(
                    ['username' => $username],
                    [
                        'name'              => substr($userData['name'] ?? $username, 0, 100),
                        'email'             => $username . '@behance-scraped.com',
                        'password'          => Hash::make('password'),
                        'avatar'            => substr($userData['avatar'] ?? '', 0, 255),
                        'location'          => substr($userData['location'] ?? '', 0, 100),
                        'role'              => 'user',
                        'email_verified_at' => now(),
                    ]
                );

                if ($user->wasRecentlyCreated) $totalUser++;

                // ── 2. Buat Project ────────────────────────────
                $title = substr($item['title'] ?? 'Untitled', 0, 255);
                if (!$title) { $gagal++; $bar->advance(); continue; }

                // Buat slug unik
                $slugBase = Str::slug($title);
                $slug     = $slugBase . '-' . Str::random(5);

                // Hindari duplikat slug
                while (Project::where('slug', $slug)->exists()) {
                    $slug = $slugBase . '-' . Str::random(6);
                }

                // Parse tanggal
                $createdAt = now();
                if (!empty($item['published_on'])) {
                    try {
                        $createdAt = \Carbon\Carbon::parse($item['published_on']);
                    } catch (\Exception $e) {
                        $createdAt = now();
                    }
                }

                $project = Project::create([
                    'user_id'        => $user->id,
                    'title'          => $title,
                    'description'    => substr($item['description'] ?? '', 0, 2000),
                    'cover_image'    => substr($item['cover_image'] ?? '', 0, 255),
                    'slug'           => $slug,
                    'status'         => 'published',
                    'views_count'    => (int)($item['views_count'] ?? 0),
                    'likes_count'    => (int)($item['likes_count'] ?? 0),
                    'comments_count' => 0,
                    'created_at'     => $createdAt,
                    'updated_at'     => now(),
                ]);
                $totalProject++;

                // ── 3. Gambar tambahan ─────────────────────────
                $sortOrder = 0;
                foreach ($item['images'] ?? [] as $img) {
                    $imgPath = substr($img['image_path'] ?? '', 0, 255);
                    if (!$imgPath) continue;

                    ProjectImage::create([
                        'project_id' => $project->id,
                        'image_path' => $imgPath,
                        'caption'    => substr($img['caption'] ?? '', 0, 255),
                        'sort_order' => $sortOrder++,
                        'mime_type'  => 'image/jpeg',
                    ]);
                    $totalImage++;
                }

                // ── 4. Assign kategori ─────────────────────────
                $catIds = [];
                foreach ($item['categories'] ?? [] as $catName) {
                    $key = strtolower(trim($catName));

                    // Cari exact match dulu
                    if (isset($catLower[$key])) {
                        $catIds[] = $catLower[$key];
                        continue;
                    }

                    // Cari partial match
                    foreach ($catLower as $cKey => $cId) {
                        if (str_contains($cKey, $key) || str_contains($key, $cKey)) {
                            $catIds[] = $cId;
                            break;
                        }
                    }
                }

                // Kalau tidak ada match, assign kategori acak
                if (empty($catIds) && !empty($categories)) {
                    $catIds = [array_values($categories)[array_rand($categories)]];
                }

                if (!empty($catIds)) {
                    $project->categories()->syncWithoutDetaching(array_unique($catIds));
                }

                $bar->advance();
            }

            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("\nError: " . $e->getMessage());
            return;
        }

        $bar->finish();

        $this->newLine(2);
        $this->info("✅  Import selesai!");
        $this->table(
            ['Keterangan', 'Jumlah'],
            [
                ['Project berhasil diimport', $totalProject],
                ['User baru dibuat',          $totalUser],
                ['Gambar diimport',           $totalImage],
                ['Project gagal',             $gagal],
            ]
        );

        // Update counter denormalisasi
        $this->info("\nUpdate likes_count & comments_count...");
        DB::statement('UPDATE projects p SET
            likes_count    = GREATEST(likes_count, (SELECT COUNT(*) FROM likes    WHERE project_id = p.id)),
            comments_count = (SELECT COUNT(*) FROM comments WHERE project_id = p.id)
        ');

        $this->info("✅  Semua counter terupdate.");
        $this->info("\nSekarang jalankan:");
        $this->line("  php artisan serve");
        $this->line("  Buka: http://localhost:8000");
    }
}