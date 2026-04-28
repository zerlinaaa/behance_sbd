<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    private array $feedbacks = [
        'Amazing work! The color palette is stunning.',
        'Love the minimalist approach here.',
        'Great composition, very professional.',
        'The typography choice is spot on!',
        'Incredible attention to detail.',
        'This is exactly the kind of work I was looking for.',
        'Clean and elegant. Well done!',
        'The concept is really well executed.',
        'Can you share what tools you used?',
        'Following for more! This is fantastic.',
    ];

    public function definition(): array
    {
        // 70% komentar biasa, 30% lebih panjang dari faker
        $text = $this->faker->boolean(70)
            ? $this->faker->randomElement($this->feedbacks)
            : $this->faker->paragraph(2);

        return [
            'project_id'   => Project::factory(),
            'user_id'      => User::factory(),
            'parent_id'    => null,               // diset di Seeder untuk reply
            'comment_text' => $text,
            'is_approved'  => $this->faker->boolean(95),  // 95% approved
            'created_at'   => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}