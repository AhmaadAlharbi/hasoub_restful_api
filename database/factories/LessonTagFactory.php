<?php

namespace Database\Factories;

use App\Models\Tag;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LessonTag>
 */
class LessonTagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lesson_id' => Lesson::factory(), // Creates or associates with a Lesson
            'tag_id' => Tag::factory(), // Creates or associates with a Tag
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}