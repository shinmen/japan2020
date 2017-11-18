<?php

namespace App\Tests\Infrastructure\EventStore;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class EventStoreStreamWriterTest extends TestCase
{
    public function testCreateStream(): void
    {
        $client = new Client(['base_uri' => 'http://127.0.0.1:2113']);
        $response = $client->request('POST', '/streams/$stream_test', [
                'headers' => [
                    'ES-EventType' => 'type_test',
                    'ES-EventId' => 'C322E299-CB73-4B47-97C5-5054F920746E',
                ],
                'auth' => ['admin', 'changeit'],
                'json' => [
                    'test' => 'test',
                ]
            ]
        );

        var_dump((string)$response->getBody());   
    }
}

