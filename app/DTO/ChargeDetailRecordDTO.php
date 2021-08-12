<?php


namespace App\DTO;


use App\Http\Requests\CalculateRateRequest;
use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

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
