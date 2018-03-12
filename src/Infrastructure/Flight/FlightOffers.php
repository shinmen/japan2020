<?php 

namespace App\Infrastructure\Flight;

use GuzzleHttp\ClientInterface;

final class FlightOffers
{
    const FLIGHT_REQUEST_URL = '/air/api/search/searchflightavailability';

    private $httpClient;
    private $mapper;
    private $loginCredentials;
    private $passwordCredentials;

    public function __construct(
        ClientInterface $httpClient,
        FlightRequestToFlightPlanMapper $mapper,
        string $loginCredentials,
        string $passwordCredentials
    ) {
        $this->httpClient = $httpClient;
        $this->mapper = $mapper;
        $this->loginCredentials = $loginCredentials;
        $this->passwordCredentials = $passwordCredentials;
    }


    public function getFlightOffers(FlightRequest $request)
    {
        $response = $this->httpClient->request('POST', self::FLIGHT_REQUEST_URL,
            [
                'auth' => [ $this->loginCredentials, $this->passwordCredentials ],
                'json' => $request->buildRequest(),
            ]
        );

        return $this->mapper->buildFlightPlans(json_decode((string) $response->getBody(), true));
    }
}
