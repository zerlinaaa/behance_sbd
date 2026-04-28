<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectImageFactory extends Factory
{
    public function definition(): array
    {
        $imgId = $this->faker->numberBetween(1, 1000);
        $w     = $this->faker->randomElement([800, 1200, 1600]);
        $h     = $this->faker->randomElement([600, 900, 1200]);

        return [
            'project_id'  => Project::factory(),
            'image_path'  => "https://picsum.photos/seed/{$imgId}/{$w}/{$h}",
            'caption'     => $this->faker->optional(0.5)->sentence(6),
            'sort_order'  => $this->faker->numberBetween(0, 10),
            'mime_type'   => $this->faker->randomElement([
                                'image/jpeg', 'image/png', 'image/webp'
                              ]),
            'file_size'   => $this->faker->numberBetween(100000, 5000000),
        ];
    }
}