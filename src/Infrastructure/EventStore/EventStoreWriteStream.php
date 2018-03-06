<?php 

namespace App\Infrastructure\EventStore;

use GuzzleHttp\ClientInterface;

final class EventStoreWriteStream
{
    private $httpClient;
    private $esLogin;
    private $esPassword;

    public function __construct(ClientInterface $httpClient, string $esLogin, string $esPassword)
    {
        $this->httpClient = $httpClient;
	$this->esLogin = $esLogin;
	$this->esPassword = $esPassword;
    }

    public function writeBatchEvent(array $events)
    {
        $response = $this->httpClient->request('POST', '/streams/$stream_test', [
                'headers' => [
                    // 'ES-EventType' => 'type_test',
                    // 'ES-EventId' => 'C322E299-CB73-4B47-97C5-5054F920746A',
                    'Content-Type' => 'application/vnd.eventstore.events+json',
                ],
                'auth' => [$this->esLogin, $this->esPassword],
                'json' => $events
            ]
        );

        return $response;
    }
}
