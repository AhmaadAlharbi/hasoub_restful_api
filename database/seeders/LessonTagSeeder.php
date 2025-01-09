<?php

namespace Database\Seeders;

use App\Models\LessonTag;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LessonTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LessonTag::factory()->count(20)->create(); // Creates 20 records

    }
}