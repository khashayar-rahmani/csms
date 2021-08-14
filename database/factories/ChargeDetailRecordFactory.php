<?php

namespace Database\Factories;

use App\DTO\ChargeDetailRecordDTO;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as SecondaryFactory;

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
        $secondaryFactory = SecondaryFactory::create();

        return [
            'meterStart'        => $this->faker->randomNumber(5),
            'meterStop'         => $this->faker->randomNumber(6),
            'timestampStart'    => new Carbon($secondaryFactory->dateTimeBetween($startDate = '-3 hours', $endDate = '-2 hours')),
            'timestampStop'     => new Carbon($secondaryFactory->dateTimeBetween($startDate = '-1 hours', $endDate = 'now'))
        ];
    }
}
