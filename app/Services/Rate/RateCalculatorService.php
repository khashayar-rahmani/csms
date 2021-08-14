<?php


namespace App\Services\Rate;


use App\DTO\CalculatedRateDTO;
use App\DTO\ChargeDetailRecordDTO;
use App\DTO\ComponentDTO;
use App\DTO\RateDTO;
use App\Helper\FloatingPointHelper;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class RateCalculatorService implements RateCalculatorInterface
{

    /**
     * @param RateDTO $rate
     * @param ChargeDetailRecordDTO $cdr
     * @return CalculatedRateDTO
     * @throws UnknownProperties
     */

    public function calculateRate(RateDTO $rate, ChargeDetailRecordDTO $cdr): CalculatedRateDTO
    {
        // Calculating amount of consumed energy
        $consumedEnergy = $cdr->meterStop - $cdr->meterStart;

        $timeStampStartInCarbon = $cdr->timestampStart;
        $timeStampStopInCarbon = $cdr->timestampStop;
        $duration = $timeStampStopInCarbon->diffInMinutes($timeStampStartInCarbon);

        // Calculating rates
        $durationRate = $duration * $rate->time;
        $energyRate = $consumedEnergy * $rate->energy;

        // Converting units
        $hourlyRate = $durationRate / 60;
        $perKWRate = $energyRate / 1000;

        $consumedEnergyPrice = FloatingPointHelper::getCalculableNumber($perKWRate);
        $durationPrice = FloatingPointHelper::getCalculableNumber($hourlyRate);

        $overall = FloatingPointHelper::getOutPutFormattedNumber($consumedEnergyPrice + $durationPrice + $rate->transaction);

        return new CalculatedRateDTO(
            overall: $overall,
            component: new ComponentDTO(
                energy: $consumedEnergyPrice,
                time: $durationPrice,
                transaction: $rate->transaction,
            )
        );
    }
}
