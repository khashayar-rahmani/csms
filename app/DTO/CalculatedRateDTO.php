<?php


namespace App\DTO;


use Spatie\DataTransferObject\DataTransferObject;

class CalculatedRateDTO extends DataTransferObject
{
    public float $overall;

    public ComponentDTO $component;
}
