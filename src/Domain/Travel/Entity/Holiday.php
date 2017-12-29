<?php

namespace Domain\Travel\Entity;

use App\Domain\AggregateRoot;
use Domain\Travel\ValueObject\Flight;

final class Holiday extends AggregateRoot
{
    private $startedAt;

    private $endedAt;

    private $daySchedules;

    private $railPassPackage;

    private $flightPlan;


    private function __construct(){}

    public function bookFlight(Flight $flight)
    {
        $this->applyEvent(new FlightPlanSelected($this->guid, $flight));
    }


    protected function loadFlightPlanSelected(FlightPlanSelected $event)
    {
        $this->flightPlan = new Flight(
            $event->getFlightNumber(),
            $event->getCompanyName()//to continue
        );
    }

    // protected function loadOne(EventOne $event)
    // {
           
    // }

    // protected function loadTwo(EventTwo $event)
    // {

    // }
}
