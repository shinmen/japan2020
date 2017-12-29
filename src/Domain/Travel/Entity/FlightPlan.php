<?php

namespace Domain\Travel\Entity;

use Domain\Travel\ValueObject\Flight;
use Datetime;

final class FlightPlan
{
    private $arrivalDate;

    private $departureDate;

    private $rate;

    public function __construct(Flight $flight)
    {
        $this->flight = $flight;
    }

    public function getFlightInfo(): Flight
    {
        return $this->flight;
    }

    public function getArrivalDate(): DateTime
    {
        return $this->arrivalDate;
    }

    public function getDepartureDate(): DateTime
    {
        return $this->departureDate;
    }

    public function getRate(): float
    {
        return $this->rate;
    }
}
