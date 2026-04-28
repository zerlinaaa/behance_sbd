<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->name();
        $username = Str::slug(
            $this->faker->unique()->userName() . $this->faker->randomNumber(3)
        );

        return [
            'name'               => $name,
            'username'           => $username,
            'email'              => $this->faker->unique()->safeEmail(),
            'password'           => Hash::make('password'),  // default semua user
            'bio'                => $this->faker->optional(0.7)->paragraph(2),
            'avatar'             => 'https://i.pravatar.cc/150?u=' . $username,
            'location'           => $this->faker->optional(0.6)->city(),
            'website'            => $this->faker->optional(0.4)->url(),
            'role'               => 'user',
            'followers_count'    => 0,
            'following_count'    => 0,
            'email_verified_at'  => now(),
            'remember_token'     => Str::random(10),
        ];
    }

    /** State: jadikan admin */
    public function admin(): static
    {
        return $this->state(fn(array $attributes) => [
            'role'  => 'admin',
            'email' => 'admin@behance.test',
        ]);
    }

    /** State: user tanpa avatar */
    public function noAvatar(): static
    {
        return $this->state(fn(array $attributes) => [
            'avatar' => null,
        ]);
    }
}