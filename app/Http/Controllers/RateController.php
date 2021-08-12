<?php

namespace App\Http\Controllers;

use App\DTO\ChargeDetailRecordDTO;
use App\DTO\RateDTO;
use App\Http\Requests\CalculateRateRequest;
use App\Http\Resources\CalculatedRateResource;
use App\Services\Rate\RateCalculatorInterface;

class RateController extends Controller
{
    private RateCalculatorInterface $rateCalculatorService;

    public function __construct(RateCalculatorInterface $rateCalculatorService)
    {
        $this->rateCalculatorService = $rateCalculatorService;
    }

    /**
     * @param CalculateRateRequest $request
     * @return CalculatedRateResource
     */

    public function calculateRate(CalculateRateRequest $request): CalculatedRateResource
    {
        $chargeDetailRecordDTO = ChargeDetailRecordDTO::fromRequest($request);
        $rateDTO = RateDTO::fromRequest($request);

        return new CalculatedRateResource($this->rateCalculatorService->calculateRate($rateDTO, $chargeDetailRecordDTO));
    }
}
