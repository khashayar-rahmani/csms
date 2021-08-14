<?php

namespace Tests\Feature;

use App\DTO\ChargeDetailRecordDTO;
use App\DTO\RateDTO;
use Illuminate\Http\Response;
use Tests\TestCase;

class RateControllerTest extends TestCase
{
    // Just testing if endpoint is up and working
    public function test_making_an_api_request()
    {
        // Creating rate and cdr objects with random values
        $rate = RateDTO::factory()->make();
        $cdr = ChargeDetailRecordDTO::factory()->make();

        $response = $this->postJson('/api/rate', [
            'rate'  => $rate,
            'cdr'   => $cdr
        ]);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function test_making_an_api_request_with_invalid_request_body()
    {
        // Creating rate and cdr objects with random values
        $rate = RateDTO::factory()->make();

        // Setting the meterStart bigger than meterStop and inserting wrong value for timestampStart
        $cdr = [
            'meterStart'        => 1215230,
            'meterStop'         => 1204307,
            'timestampStart'    => 0,
            'timestampStop'     => '2021-04-05T10:04:00Z',
        ];

        $response = $this->postJson('/api/rate', [
            'rate'  => $rate,
            'cdr'   => $cdr
        ]);
        $response
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJsonValidationErrors(['cdr.meterStop', 'cdr.timestampStart']);
    }

    public function test_making_an_api_request_and_validating_the_response()
    {
        // Creating rate and cdr objects with random values
        $rate = RateDTO::factory()->make();
        $cdr = ChargeDetailRecordDTO::factory()->make();

        $response = $this->postJson('/api/rate', [
            'rate'  => $rate,
            'cdr'   => $cdr
        ]);
        $response
            ->assertStatus(Response::HTTP_OK)
            ->assertJsonStructure([
                'overall',
                'component' => [
                    'energy',
                    'time',
                    'transaction'
                ]
            ]);
    }
}
