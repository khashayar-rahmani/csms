<?php


namespace App\Services\Rate;


use App\DTO\CalculatedRateDTO;
use App\DTO\ChargeDetailRecordDTO;
use App\DTO\RateDTO;

interface RateCalculatorInterface
{
    public function calculateRate(RateDTO $rate, ChargeDetailRecordDTO $cdr) :CalculatedRateDTO;
}
