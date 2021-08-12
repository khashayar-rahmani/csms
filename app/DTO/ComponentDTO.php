<?php


namespace App\DTO;


use Spatie\DataTransferObject\DataTransferObject;

/**
 * @OA\Schema(
 *     schema="Component",
 *     title="Component",
 *     description="Component's prices",
 *     @OA\Xml(name="ComponentDTO"),
 *
 *     @OA\Property(property="energy", type="float", example="3.277"),
 *     @OA\Property(property="time", type="float", example="2.767"),
 *     @OA\Property(property="transaction", type="float", example="1"),
 * )
 */

class ComponentDTO extends DataTransferObject
{
    public float $energy;
    public float $time;
    public float $transaction;
}
