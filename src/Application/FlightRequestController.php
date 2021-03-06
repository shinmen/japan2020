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

    //private $producer;

    public function __construct(FlightOffers $flightOffers)
    {
        $this->flightOffers = $flightOffers;
        //$this->producer = $producer;
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
            $flightRequestParams['destinationCode'],
            $flightRequestParams['originCode'],
            new Datetime($flightRequestParams['returnDate'])
        );
        $flightRequest = new FlightRequest($goingTrip, $returnTrip);
        $flightPlans = $this->flightOffers->getFlightOffers($flightRequest);
        //$this->dispatchOffers($flightPlans);

        return new JsonResponse($flightPlans);
    }

    // private function dispatchOffers(array $flightPlans)
    // {
    //     foreach ($flightPlans as $flightPlan) {
    //         $this->producer->publish(serialize($flightPlan));
    //     }
    // }
}
