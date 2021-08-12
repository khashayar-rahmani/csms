<?php


namespace App\Helper;


class FloatingPointHelper
{
    /**
     * @param float $number
     * @return float
     */
    static function getCalculableNumber(float $number): float
    {
        return round($number, 3);
    }

    /**
     * @param float $number
     * @return float
     */
    static function getOutputFormattedNumber(float $number): float
    {
        return round($number, 2);
    }
}
