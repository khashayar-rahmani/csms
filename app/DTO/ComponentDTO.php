<?php


namespace App\DTO;


use Spatie\DataTransferObject\DataTransferObject;

class ComponentDTO extends DataTransferObject
{
    public float $energy;
    public float $time;
    public float $transaction;
}
