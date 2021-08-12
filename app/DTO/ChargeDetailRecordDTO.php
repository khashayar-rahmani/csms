<?php


namespace App\DTO;


use App\Http\Requests\CalculateRateRequest;
use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

/**
 * @OA\Schema(
 *     schema="cdr",
 *     title="cdr",
 *     description="Charge detail record",
 *     @OA\Xml(name="ChargeDetailRecord"),
 *
 *     @OA\Property(property="timestampStart", type="date-time", example="2021-04-05T10:04:00Z"),
 *     @OA\Property(property="timestampStop", type="date-time", example="2021-04-05T11:27:00Z"),
 *     @OA\Property(property="meterStart", type="integer", example="1204307"),
 *     @OA\Property(property="meterStop", type="integer", example="1215230"),
 * )
 */

class ChargeDetailRecordDTO extends DataTransferObject
{
    public int $meterStart;
    public int $meterStop;
    public Carbon $timestampStart;
    public Carbon $timestampStop;

    public static function fromRequest(CalculateRateRequest $request): ChargeDetailRecordDTO
    {
        $cdr = $request->input('cdr');
        return new self(
            meterStart: $cdr['meterStart'],
            meterStop: $cdr['meterStop'],
            timestampStart: new Carbon($cdr['timestampStart']),
            timestampStop: new Carbon($cdr['timestampStop'])
        );
    }
}
