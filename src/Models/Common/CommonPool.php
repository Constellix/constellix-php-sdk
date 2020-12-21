<?php

declare(strict_types=1);

namespace Constellix\Client\Models\Common;

use Constellix\Client\Enums\Pools\PoolType;
use Constellix\Client\Interfaces\Managers\PoolManagerInterface;
use Constellix\Client\Interfaces\Models\Common\CommonPoolInterface;
use Constellix\Client\Interfaces\Models\Common\CommonPoolValueInterface;
use Constellix\Client\Interfaces\Models\Basic\BasicDomainInterface;
use Constellix\Client\Interfaces\Models\Basic\BasicTemplateInterface;
use Constellix\Client\Interfaces\Models\Helpers\ITOInterface;
use Constellix\Client\Interfaces\Traits\ManagedModelInterface;
use Constellix\Client\Models\AbstractModel;
use Constellix\Client\Models\Basic\BasicDomain;
use Constellix\Client\Models\Basic\BasicTemplate;
use Constellix\Client\Models\Helpers\ITO;
use Constellix\Client\Traits\ManagedModel;

/**
 * Represents a Pool resource.
 * @package Constellix\Client\Models
 *
 * @property PoolType $type
 * @property string $name
 * @property int $return
 * @property int $minimumFailover
 * @property-read bool $failed
 * @property bool $enabled
 * @property BasicDomainInterface[] $domains
 * @property BasicTemplateInterface[] $templates
 * @property ITOInterface $ito
 * @property CommonPoolValueInterface[] $values
 */
abstract class CommonPool extends AbstractModel implements CommonPoolInterface, ManagedModelInterface
{
    use ManagedModel;

    /**
     * @var PoolManagerInterface
     */
    protected $manager;

    protected array $props = [
        'name' => null,
        'type' => null,
    ];

    protected function parseApiData(object $data): void
    {
        parent::parseApiData($data);
        if (property_exists($data, 'type') && $data->type) {
            $this->props['type'] = PoolType::make($data->type);
        }

        $this->props['domains'] = [];
        if (property_exists($data, 'domains') && $data->domains) {
            $this->props['domains'] = array_map(function($domainData) {
                return new BasicDomain($this->client->domains, $this->client, $domainData);
            }, $data->domains);
        }

        $this->props['templates'] = [];
        if (property_exists($data, 'templates') && $data->templates) {
            $this->props['templates'] = array_map(function($templateData) {
                return new BasicTemplate($this->client->templates, $this->client, $templateData);
            }, $data->templates);
        }

        if (property_exists($data, 'ito') && $data->ito) {
            $this->props['ito'] = new ITO($data->ito);
        }
    }
}