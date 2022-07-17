<?php

namespace Database\Factories;

use App\Models\Calendar;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CalendarFactory extends Factory
{
    protected $model = Calendar::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'institution_id' => Event::factory(),
        ];
    }
}
