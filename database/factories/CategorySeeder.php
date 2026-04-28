<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    // Data kategori persis seperti Behance asli
    private array $categories = [
        ['name' => 'Graphic Design',    'icon' => 'pen-tool'],
        ['name' => 'UI/UX',             'icon' => 'monitor'],
        ['name' => 'Photography',       'icon' => 'camera'],
        ['name' => 'Illustration',      'icon' => 'image'],
        ['name' => 'Motion Graphics',   'icon' => 'film'],
        ['name' => 'Branding',          'icon' => 'tag'],
        ['name' => 'Web Design',        'icon' => 'layout'],
        ['name' => 'Typography',        'icon' => 'type'],
        ['name' => '3D & Animation',    'icon' => 'box'],
        ['name' => 'Industrial Design', 'icon' => 'tool'],
        ['name' => 'Fashion',           'icon' => 'scissors'],
        ['name' => 'Architecture',      'icon' => 'home'],
        ['name' => 'Advertising',       'icon' => 'megaphone'],
        ['name' => 'Packaging',         'icon' => 'package'],
        ['name' => 'Game Design',       'icon' => 'gamepad'],
        ['name' => 'Product Design',    'icon' => 'cpu'],
        ['name' => 'Fine Art',          'icon' => 'feather'],
        ['name' => 'Print',             'icon' => 'printer'],
        ['name' => 'Social Media',      'icon' => 'share-2'],
        ['name' => 'Video',             'icon' => 'video'],
    ];

    public function run(): void
    {
        foreach ($this->categories as $cat) {
            Category::create([
                'name'        => $cat['name'],
                'slug'        => Str::slug($cat['name']),
                'description' => 'Projects related to ' . $cat['name'],
                'icon'        => $cat['icon'],
                'is_active'   => true,
            ]);
        }
    }
}