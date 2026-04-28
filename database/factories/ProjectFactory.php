<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProjectFactory extends Factory
{
    // Judul-judul realistis ala Behance
    private array $adjectives = [
        'Modern', 'Minimal', 'Bold', 'Abstract', 'Urban',
        'Vintage', 'Elegant', 'Dark', 'Vibrant', 'Clean',
        'Geometric', 'Organic', 'Editorial', 'Retro', 'Futuristic',
    ];

    private array $projectTypes = [
        'Brand Identity', 'Logo Design', 'UI/UX Design',
        'Poster Series', 'Photography', 'Illustration',
        'Motion Graphics', 'Typography', 'Packaging Design',
        'Web Design', 'Mobile App', '3D Art',
    ];

    public function definition(): array
    {
        $title = $this->faker->randomElement($this->adjectives) . ' '
                . $this->faker->randomElement($this->projectTypes);

        // Slug unik: "modern-brand-identity-a3f9"
        $slug = Str::slug($title) . '-' . Str::random(4);

        // Cover dari Picsum (gambar acak konsisten per seed)
        $coverId = $this->faker->numberBetween(1, 1000);

        return [
            'user_id'        => User::factory(),  // buat user baru jika tidak di-set
            'title'          => $title,
            'description'    => $this->faker->optional(0.85)->paragraphs(3, true),
            'cover_image'    => "https://picsum.photos/seed/{$coverId}/800/600",
            'slug'           => $slug,
            'status'         => $this->faker->randomElement([
                                    'published', 'published', 'published',
                                    'draft', 'archived'  // 60% published
                                ]),
            'views_count'    => $this->faker->numberBetween(0, 50000),
            'likes_count'    => 0,     // akan diupdate oleh Trigger
            'comments_count' => 0,
            'created_at'     => $this->faker->dateTimeBetween('-2 years', 'now'),
        ];
    }

    /** State: hanya project published */
    public function published(): static
    {
        return $this->state(fn(array $attr) => ['status' => 'published']);
    }
}