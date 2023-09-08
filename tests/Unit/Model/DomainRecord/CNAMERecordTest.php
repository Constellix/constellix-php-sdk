<?php

namespace Constellix\Client\Tests\Unit\Model\DomainRecord;

use Constellix\Client\Enums\Records\RecordMode;
use Constellix\Client\Enums\Records\RecordType;
use Constellix\Client\Models\Helpers\RecordValues\Standard;
use GuzzleHttp\Psr7\Response;

class CNAMERecordTest extends RecordTestCase
{
    // We only care about the record type
    public function testApiDataParsedCorrectly(): void
    {
        $this->mock->append(new Response(200, [], $this->getFixture('responses/domainrecord/cname.json')));
        $record = $this->domain->records->get(732673);
        $this->assertEquals(RecordType::CNAME(), $record->type);

        $this->assertCount(1, $record->value);
        $this->assertInstanceOf(Standard::class, $record->value[0]);
        $this->assertEquals('myrecord.example.com', $record->value[0]->value);
        $this->assertTrue($record->value[0]->enabled);
    }

    public function testDataSentToApiCorrectly(): void
    {
        $history = &$this->history();

        $record = $this->domain->records->create();
        $record->name = 'www';
        $record->type = RecordType::CNAME();

        $value = new Standard();
        $value->value = 'mydomain.example.com';
        $record->addValue($value);

        $this->assertEquals(RecordMode::STANDARD(), $record->mode);

        $this->mock->append(new Response(201, [], $this->getFixture('responses/domainrecord/create.json')));
        $record->save();

        $this->assertCount(1, $history);
        $this->assertJsonStringEqualsJsonString($this->getFixture('requests/domainrecord/create-cname.json'), $history[0]['request']->getBody());
    }
}
