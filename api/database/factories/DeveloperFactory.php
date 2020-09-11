<?php

namespace Database\Factories;

use App\Models\Developer;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeveloperFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Developer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome'            => $this->faker->name,
            'sexo'            => $this->faker->randomElement(['M', 'F']),
            'idade'           => $this->faker->numberBetween(1, 99),
            'hobby'           => $this->faker->word,
            'data_nascimento' => $this->faker->date()
        ];
    }
}
