<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Guardian;
use App\Models\Promotion;
use App\Models\Student;
use App\Models\Subsidiary;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone_number' => $this->faker->phoneNumber(),
            'matriculate' => $this->faker->word(),
            'images' => $this->faker->word(),
            'nationality' => $this->faker->word(),
            'location' => $this->faker->word(),
            'identity_card' => $this->faker->word(),
            'birthdays' => Carbon::now(),
            'born_city' => $this->faker->city(),
            'born_town' => $this->faker->word(),
            'parent_name' => $this->faker->name(),
            'parent_phone' => $this->faker->phoneNumber(),
            'gender' => $this->faker->word(),
            'address' => $this->faker->address(),
            'status' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'admission_date' => Carbon::now(),

            'user_id' => User::factory(),
            'department_id' => Department::factory(),
            'subsidiary_id' => Subsidiary::factory(),
            'promotion_id' => Promotion::factory(),
            'guardian_id' => Guardian::factory(),
        ];
    }
}
