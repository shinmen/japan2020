<?php

namespace App\Application;

use App\Domain\Travel\DTO\FlightPlan;
use App\Infrastructure\Flight\FlightOffers;
use App\Infrastructure\Flight\FlightRequest;
use App\Infrastructure\Flight\TripRequest;
use Datetime;
use OldSound\RabbitMqBundle\RabbitMq\Producer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class FlightRequestController
{
    private $flightOffers;

    private $producer;

    public function __construct(FlightOffers $flightOffers, Producer $producer)
    {
        $this->flightOffers = $flightOffers;
        $this->producer = $producer;
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
        $this->dispatchOffers($flightPlans);

        return new JsonResponse($flightPlans);
    }

    private function dispatchOffers(array $flightPlans)
    {
        $producer = $this->producer;
        array_map(function(FlightPlan $flightPlan) use ($producer) {
            $producer->publish(serialize($flightPlan));
        }, $flightPlans);
    }
}
