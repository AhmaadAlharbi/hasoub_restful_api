<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Lesson::class;

    public function definition(): array
    {

        return [
            'user_id' => User::factory(), // Creates a related User if not provided
            'title' => $this->faker->sentence(3), // Generates a random title
            'body' => $this->faker->paragraph(5), // Generates a random body
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}