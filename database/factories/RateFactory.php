<?php

namespace Database\Factories;

use App\DTO\RateDTO;
use Illuminate\Database\Eloquent\Factories\Factory;

class RateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = RateDTO::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'energy'        => $this->faker->randomFloat(1, 0.1, 1),
            'time'          => $this->faker->randomNumber(1),
            'transaction'   => $this->faker->randomNumber(1)
        ];
    }
}
