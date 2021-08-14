<?php

namespace Database\Factories;

use App\DTO\ChargeDetailRecordDTO;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

class ChargeDetailRecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = ChargeDetailRecordDTO::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $faker = Faker::create();

        return [
            'meterStart'        => $this->faker->randomNumber(5),
            'meterStop'         => $this->faker->randomNumber(6),
            'timestampStart'    => new Carbon($faker->dateTimeBetween($startDate = '-3 hours', $endDate = '-2 hours')),
            'timestampStop'     => new Carbon($faker->dateTimeBetween($startDate = '-1 hours', $endDate = 'now'))
        ];
    }
}
