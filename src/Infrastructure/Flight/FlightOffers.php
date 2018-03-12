<?php 

namespace App\Infrastructure\Flight;

use GuzzleHttp\ClientInterface;

final class FlightOffers
{
    private $httpClient;
    private $mapper;

    public function __construct(ClientInterface $htpClient, FlightRequestToFlightPlanMapper $mapper)
    {
        $this->httpClient = $httpClient;
        $this->mapper = $mapper;
    }


    public function getFlightOffers(FlightRequest $request)
    {
        
    }
}
