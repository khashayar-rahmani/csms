<?php


namespace App\DTO;


use App\Http\Requests\CalculateRateRequest;
use Database\Factories\RateFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\DataTransferObject\DataTransferObject;

/**
 * @OA\Schema(
 *     schema="rate",
 *     title="rate",
 *     description="Rate",
 *     @OA\Xml(name="Rate"),
 *
 *     @OA\Property(property="energy", type="float", example="0.3"),
 *     @OA\Property(property="time", type="float", example="2"),
 *     @OA\Property(property="transaction", type="float", example="1"),
 * )
 */

class RateDTO extends DataTransferObject
{
    use HasFactory;

    public float $energy;
    public float $time;
    public float $transaction;

    public static function newFactory(): RateFactory
    {
        return RateFactory::new();
    }

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
