<?php

declare(strict_types=1);

namespace Constellix\Client\Models;

use Constellix\Client\Interfaces\Models\GeoProximityInterface;
use Constellix\Client\Interfaces\Traits\EditableModelInterface;
use Constellix\Client\Interfaces\Traits\ManagedModelInterface;
use Constellix\Client\Traits\EditableModel;
use Constellix\Client\Traits\ManagedModel;

/**
 * Represents a GeoProximity Location resource.
 * @package Constellix\Client\Models
 *
 * @property string $name
 * @property string $country
 * @property string $region
 * @property string $city
 * @property float $longitude
 * @property float $latitude
 */
class GeoProximity extends AbstractModel implements GeoProximityInterface, EditableModelInterface, ManagedModelInterface
{
    use EditableModel;
    use ManagedModel;

    protected array $props = [
        'name' => null,
        'country' => null,
        'region' => null,
        'city' => null,
        'longitude' => null,
        'latitude' => null,
    ];

    protected array $editable = [
        'name',
        'country',
        'region',
        'city',
        'longitude',
        'latitude',
    ];
}