<?php


namespace App\DTO;


use Spatie\DataTransferObject\DataTransferObject;

/**
 * @OA\Schema(
 *     schema="CalculatedRate",
 *     title="CalculatedRate",
 *     description="Calculated rate",
 *     @OA\Xml(name="CalculatedRate"),
 *
 *     @OA\Property(property="overall", type="float", example="7.04"),
 *     @OA\Property(property="component", type="object", ref="#/components/schemas/Component"),
 * )
 */

class CalculatedRateDTO extends DataTransferObject
{
    public float $overall;

    public ComponentDTO $component;
}
