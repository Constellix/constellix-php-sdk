<?php

declare(strict_types=1);

namespace Constellix\Client\Models\Helpers\RecordValues;

use Constellix\Client\Models\Helpers\RecordValue;

/**
 * Represents the data for HTTP redirection records.
 * @package Constellix\Client\Models\RecordValues
 */
class HttpRedirection extends RecordValue
{
    public bool $hard;
    public int $redirectType;
    public ?string $title;
    public ?string $keywords;
    public ?string $description;
    public string $url;
}
