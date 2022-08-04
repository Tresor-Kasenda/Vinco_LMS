<?php

namespace Database\Factories;

use App\Models\Chapter;
use App\Models\Course;
use App\Models\Exercice;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ExerciceFactory extends Factory
{
    protected $model = Exercice::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'rating' => $this->faker->randomFloat(),
            'filling_date' => Carbon::now(),
            'status' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'course_id' => Course::factory(),
            'chapter_id' => Chapter::factory(),
            'lesson_id' => Lesson::factory(),
        ];
    }
}
