<?php
// =====================================================================
// FIX #3c — Buat file BARU ini:
// database/seeders/UsersSeeder.php
//
// Membuat user admin + 671 user kreator (1 per project)
// =====================================================================

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->truncate();

        // ── User ID 1: Admin ──────────────────────────────────────
        DB::table('users')->insert([
            'id'           => 1,
            'name'         => 'Admin Behance',
            'username'     => 'admin',
            'email'        => 'admin@behance.test',
            'password'     => Hash::make('password'),
            'role'         => 'admin',
            'bio'          => 'Administrator platform',
            'avatar'       => null,
            'location'     => 'San Francisco, CA',
            'availability' => 'not_available',
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        // ── 670 User Kreator (ID 2 sampai 671) ───────────────────
        $availabilities = ['available', 'freelance', 'fulltime', 'not_available'];
        $locations = [
            'New York, NY', 'London, UK', 'Tokyo, Japan', 'Paris, France',
            'Berlin, Germany', 'Los Angeles, CA', 'Sydney, Australia',
            'Toronto, Canada', 'Amsterdam, Netherlands', 'Seoul, South Korea',
            'Singapore', 'Barcelona, Spain', 'Mumbai, India', 'Dubai, UAE',
            'São Paulo, Brazil', 'Mexico City, Mexico', 'Jakarta, Indonesia',
        ];

        $rows = [];
        for ($i = 2; $i <= 671; $i++) {
            $n = $i - 1;
            $rows[] = [
                'id'           => $i,
                'name'         => "Creator {$n}",
                'username'     => "creator_{$n}",
                'email'        => "creator{$n}@behance.test",
                'password'     => Hash::make('password'),
                'role'         => 'user',
                'bio'          => "Creative professional #{$n}",
                'avatar'       => null,
                'location'     => $locations[($n - 1) % count($locations)],
                'availability' => $availabilities[($n - 1) % count($availabilities)],
                'followers_count' => rand(0, 5000),
                'following_count' => rand(0, 500),
                'created_at'   => now()->subDays(rand(1, 365)),
                'updated_at'   => now(),
            ];
        }

        foreach (array_chunk($rows, 100) as $chunk) {
            DB::table('users')->insert($chunk);
        }

        $this->command->info('✅ ' . (1 + count($rows)) . ' user berhasil dibuat.');
    }
}