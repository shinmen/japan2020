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
                    'Content-Type' => 'application/vnd.eventstore.events+json',
                ],
                'auth' => [$this->esLogin, $this->esPassword],
                'json' => $events
            ]
        );

        return $response;
    }
}
