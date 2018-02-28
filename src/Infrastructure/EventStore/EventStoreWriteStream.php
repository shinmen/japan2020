<?php 

namespace App\Infrastructure\EventStore;

use GuzzleHttp\ClientInterface;

final class EventStoreWriteStream
{
    private $httpClient;

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function writeBatchEvent(array $events)
    {
        $response = $this->httpClient->request('POST', '/streams/$stream_test', [
                'headers' => [
                    // 'ES-EventType' => 'type_test',
                    // 'ES-EventId' => 'C322E299-CB73-4B47-97C5-5054F920746A',
                    'Content-Type' => 'application/vnd.eventstore.events+json',
                ],
                'auth' => ['admin', 'changeit'],
                'json' => $events
            ]
        );

        return $response;
    }
}
