<?php

declare(strict_types=1);

namespace Constellix\Client\Models\Helpers\RecordValues;

use Constellix\Client\Models\Helpers\RecordValue;

/**
 * Represents the data for NAPTR records.
 * @package Constellix\Client\Models\RecordValues
 */
class NAPTR extends RecordValue
{
    public bool $enabled = true;
    public int $order;
    public int $preference;
    public string $flags;
    public string $service;
    public string $regularExpression;
    public string $replacement;
}
