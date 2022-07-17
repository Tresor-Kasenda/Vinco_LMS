<?php

namespace Database\Factories;

use App\Models\Expense;
use App\Models\ExpenseType;
use App\Models\Institution;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ExpenseFactory extends Factory
{
    protected $model = Expense::class;

    public function definition(): array
    {
        return [
            'amount' => $this->faker->word(),
            'description' => $this->faker->text(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'expense_type_id' => ExpenseType::factory(),
            'institution_id' => Institution::factory(),
        ];
    }
}
