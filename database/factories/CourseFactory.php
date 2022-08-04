<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Course;
use App\Models\Institution;
use App\Models\Professor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CourseFactory extends Factory
{
    protected $model = Course::class;

    public function definition(): array
    {
        return [
            'professor_id' => Professor::factory(),
            'name' => $this->faker->name(),
            'sub_description' => $this->faker->text(),
            'description' => $this->faker->text(),
            'images' => $this->faker->word(),
            'weighting' => $this->faker->randomNumber(),
            'status' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'institution_id' => Institution::factory(),

            'category_id' => Category::factory(),
        ];
    }
}
