<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Institution;
use App\Models\Promotion;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'institution_id' => Institution::factory(),
            'promotion_id' => Promotion::factory(),
        ];
    }
}
