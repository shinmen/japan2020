<?php

namespace App\Application;

use App\Infrastructure\Flight\FlightOffers;
use App\Infrastructure\Flight\FlightRequest;
use App\Infrastructure\Flight\TripRequest;
use Datetime;
use Symfony\Component\HttpFoundation\JsonResponse;

class FlightRequestController
{
    private $flightOffers;

    public function __construct(FlightOffers $flightOffers)
    {
        $this->flightOffers = $flightOffers;
    }

    public function __invoke (
        string $originAirportCode,
        string $destinationAirportCode,
        string $departureDate,
        string $returnDate
    ) {
        $goingTrip = new TripRequest($originAirportCode, $destinationAirportCode, new Datetime($departureDate));
        $returnTrip = new TripRequest($destinationAirportCode, $originAirportCode, new Datetime($returnDate));
        $flightRequest = new FlightRequest($goingTrip, $returnTrip);

        $flightPlans = $this->flightOffers->getFlightOffers($flightRequest);

        return new JsonResponse($flightPlans);
    }
}
