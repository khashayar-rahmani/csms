<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculateRateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'rate.*'                => [
                'Required',
                'Numeric'
            ],
            'cdr.meterStart'        => [
                'Required',
                'Integer'
            ],
            'cdr.meterStop'         => [
                'Required',
                'Integer',
                'gte:cdr.meterStart'
            ],
            'cdr.timestampStart'    => [
                'Required',
                'Date'
            ],
            'cdr.timestampStop'     => [
                'Required',
                'Date'
            ]
        ];
    }
}
