<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\Contest;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    protected $model = Application::class;

    public function definition(): array
    {
        return [
            'contest_id' => Contest::first()->id,

            'position' => $this->faker->jobTitle(),
            'name' => $this->faker->name(),
            'gender' => $this->faker->randomElement(['male', 'female']),

            'birth_date' => $this->faker->date('Y-m-d', '-18 years'),

            'address' => $this->faker->streetAddress(),
            'governorate' => $this->faker->state(),
            'city' => $this->faker->city(),
            'postal_code' => $this->faker->postcode(),

            'cin' => $this->faker->unique()->numerify('########'),
            'cin_date' => $this->faker->date(),

            'tel' => $this->faker->phoneNumber(),

            'test_grade' => $this->faker->optional()->numberBetween(0, 20),

            'email' => $this->faker->unique()->safeEmail(),

            'status' => $this->faker->randomElement(['جديد', 'مقبول', 'مرفوض']),

            'degree' => $this->faker->optional()->randomElement([
                'Licence',
                'Master',
                'Engineering',
            ]),

            'specialty' => $this->faker->randomElement([
                'Informatique',
                'Mathématiques',
                'Physique',
                'Génie logiciel',
            ]),

            'graduation_year' => $this->faker->numberBetween(2010, now()->year),

            'equivalence_decision' => $this->faker->optional()->sentence(3),
            'equivalence_date' => $this->faker->optional()->date(),

            'bac_average' => $this->faker->randomFloat(2, 8, 20),
            'grad_average' => $this->faker->randomFloat(2, 8, 20),

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
