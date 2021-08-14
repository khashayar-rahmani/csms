<?php

namespace Tests\Unit;

use App\DTO\ChargeDetailRecordDTO;
use App\DTO\RateDTO;
use App\Helper\FloatingPointHelper;
use App\Services\Rate\RateCalculatorInterface;
use App\Services\Rate\RateCalculatorService;
use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class RateCalculatorServiceTest extends TestCase
{
    protected RateCalculatorInterface $rateCalculatorService;

    protected function setUp(): void
    {
        parent::setUp();
        $this->rateCalculatorService = app(RateCalculatorService::class);
    }

    /**
     * @throws UnknownProperties
     */
    public function test_check_the_equality_of_sum_of_the_components_with_the_overall() {

        // Creating rate and cdr objects with random values
        $rate = RateDTO::factory()->make();
        $cdr = ChargeDetailRecordDTO::factory()->make();

        $calculatedRate = $this->rateCalculatorService->calculateRate($rate, $cdr);

        $overall = $calculatedRate->overall;

        // Calculating sum of components
        $sumOfComponents = collect($calculatedRate->component->all())->sum(function ($value) {
            return $value;
        });

        $formattedSumOfComponents = FloatingPointHelper::getOutputFormattedNumber($sumOfComponents);

        // Comparing the overall value and the number obtained from sum of components
        $this->assertEquals($overall, $formattedSumOfComponents);
    }

    /**
     * @throws UnknownProperties
     */
    // Testing edge cases like when cdr amounts are equal which means
    // Only the transaction fee should be calculated
    public function test_the_check_equality_of_the_overall_with_transaction_fee_when_cdr_amounts_are_equal() {

            $rate = RateDTO::factory()->make();
            $cdr = ChargeDetailRecordDTO::factory()->make([
                'meterStart'        => 1204307,
                'meterStop'         => 1204307,
                'timestampStart'    => new Carbon('2021-04-05T10:04:00Z'),
                'timestampStop'     => new Carbon('2021-04-05T10:04:00Z'),
            ]);

        $calculatedRate = $this->rateCalculatorService->calculateRate($rate, $cdr);

        $formattedTransactionAmount = FloatingPointHelper::getOutputFormattedNumber($calculatedRate->component->transaction);

        // Checking if the overall amount is equal to transaction fee
        $this->assertEquals($calculatedRate->overall, $formattedTransactionAmount);
    }
}
