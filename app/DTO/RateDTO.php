<?php


namespace App\DTO;


use App\Http\Requests\CalculateRateRequest;
use Spatie\DataTransferObject\DataTransferObject;

class RateDTO extends DataTransferObject
{
    public float $energy;
    public float $time;
    public float $transaction;

    public static function fromRequest(CalculateRateRequest $request): RateDTO
    {
        $rate = $request->input('rate');

        return new self(
            energy: $rate['energy'],
            time: $rate['time'],
            transaction: $rate['transaction']
        );
    }
}
