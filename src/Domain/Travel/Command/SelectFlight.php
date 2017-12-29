<?php

namespace Domain\Travel\Command;

use Domain\Command;
use Domain\Travel\ValueObject\Flight;

final class SelectFlight implements Command
{
    private $holidayId;

    private $flight;

    public function __construct($id, Flight $flight)
    {
        $this->id = $id;
        $this->flight = $flight;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFlightInfo(): Flight
    {
        return $this->flight;
    }

}
