<?php 

namespace App\Infrastructure\EventStore;

use App\Domain\Travel\EventStore\EventStoreWriteInterface;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;

final class EventStoreWriteStream implements EventStoreWriteInterface
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

    /**
     * @param array[EventDescription]
     */
    public function writeBatchEvent(array $events): ResponseInterface
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
