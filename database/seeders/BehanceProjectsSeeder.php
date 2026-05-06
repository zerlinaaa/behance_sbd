<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BehanceProjectsSeeder extends Seeder
{
    public function run(): void
    {
        $path = storage_path('app/behance_data.json');

        if (!File::exists($path)) {
            echo "File JSON tidak ditemukan!";
            return;
        }

        $data = json_decode(File::get($path), true);

        foreach ($data as $item) {
            DB::table('behance_projects')->insert([
                'title' => $item['title'] ?? null,
                'url' => $item['url'] ?? null,
                'image' => $item['image'] ?? null,
                'author' => $item['author'] ?? null,
                'likes' => $item['likes'] ?? 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        echo "Import selesai!";
    }
}