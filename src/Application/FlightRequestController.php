<?php

namespace App\Application;

use App\Infrastructure\Flight\FlightOffers;
use App\Infrastructure\Flight\FlightRequest;
use App\Infrastructure\Flight\TripRequest;
use Datetime;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class FlightRequestController
{
    private $flightOffers;

    public function __construct(FlightOffers $flightOffers)
    {
        $this->flightOffers = $flightOffers;
    }

    public function __invoke (Request $request) 
    {
        $flightRequestParams = json_decode($request->getContent(), true);
        $goingTrip = new TripRequest(
            $flightRequestParams['originCode'],
            $flightRequestParams['destinationCode'],
            new Datetime($flightRequestParams['departureDate'])
        );
        $returnTrip = new TripRequest(
            $flightRequestParams['destinationAirportCode'],
            $flightRequestParams['originAirportCode'],
            new Datetime($flightRequestParams['returnDate'])
        );
        $flightRequest = new FlightRequest($goingTrip, $returnTrip);
        $flightPlans = $this->flightOffers->getFlightOffers($flightRequest);

        return new JsonResponse($flightPlans);
    }
}
