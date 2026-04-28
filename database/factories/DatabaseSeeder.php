<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,  // 1. Dulu (tidak ada FK dependency)
            BehanceSeeder::class,   // 2. Semua entitas utama
        ]);
    }
}


/*
|─────────────────────────────────────────────────────────────────
| CARA MENJALANKAN
|─────────────────────────────────────────────────────────────────
|
| # Pertama kali (fresh database):
| php artisan migrate:fresh --seed
|
| # Tambah data tanpa reset:
| php artisan db:seed
|
| # Hanya seeder tertentu:
| php artisan db:seed --class=BehanceSeeder
|
| # Cek jumlah record setelah seeding:
| php artisan tinker
| >>> \App\Models\Project::count()      // harusnya ~500
| >>> \App\Models\Like::count()         // harusnya 800
| >>> \App\Models\Comment::count()      // harusnya 600
|
|─────────────────────────────────────────────────────────────────
*/