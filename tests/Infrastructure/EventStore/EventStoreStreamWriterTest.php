<?php

namespace App\Tests\Infrastructure\EventStore;

use App\Infrastructure\EventStore\EventStoreWriteStream;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class EventStoreStreamWriterTest extends TestCase
{
    public function testCreateStream(): void
    {
        $client = new Client(['base_uri' => 'http://127.0.0.1:2113']);

        $writer = new EventStoreWriteStream($client, 'admin', 'changeit');
        $response = $writer->writeBatchEvent([
                        [
                            'eventType' => 'type_test',
                            'eventId' => 'C322E299-CB73-4B47-97C5-5054F920746A',
                            'data' => ['test' => 'test'],
                        ]
                    ]); 

        var_dump((string)$response->getStatusCode());   
    }
}

