<?php

namespace App\Http\Controllers;

use App\DTO\ChargeDetailRecordDTO;
use App\DTO\RateDTO;
use App\Http\Requests\CalculateRateRequest;
use App\Http\Resources\CalculatedRateResource;
use App\Services\Rate\RateCalculatorInterface;

class RateController extends Controller
{
    /**
     * @OA\Post(
     *      path="/rate",
     *      operationId="calculateRate",
     *      tags={"Rates"},
     *      summary="Calculates charging process rating",
     *      description="Calculates and returns charging process rating based on given charge detail record",
     *      @OA\RequestBody(
     *          required=true,
     *          description="Pass charge detail records",
     *          @OA\JsonContent(
     *              required={"rate","cdr"},
     *              @OA\Property(property="rate", ref="#/components/schemas/rate"),
     *              @OA\Property(property="cdr", ref="#/components/schemas/cdr")
     *          ),
     *          ),
     *          @OA\Response(
     *              response=200,
     *              description="Successful",
     *              @OA\JsonContent(ref="#/components/schemas/CalculatedRate")
     *          )
     *      )
     */

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
