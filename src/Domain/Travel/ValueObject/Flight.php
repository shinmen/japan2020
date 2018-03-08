<?php

namespace App\Domain\Travel\ValueObject;

use Datetime;
use Infrastructure\Flight\Airport;

final class Flight
{
    private $flightNumber;

    private $departureAirport;

    private $departureDate;

    private $arrivalAirport;

    private $arrivalDate;

    public function __construct(
        int $flightNumber,
        DateTime $departureDate,
        Datetime $arrivalDate,
        string $departureAirport,
        string $arrivalAirport
    ) {
        $this->flightNumber = $flightNumber;
        $this->arrivalDate = $arrivalDate;
        $this->departureDate = $departureDate;
        $this->departureAirport = $departureAirport;
        $this->arrivalAirport = $arrivalAirport;
    }

    public function getFlightNumber()
    {
        return $this->flightNumber;
    }

    public function getArrivalDate(): DateTime
    {
        return $this->arrivalDate;
    }

    public function getDepartureDate(): DateTime
    {
        return $this->departureDate;
    }

    public function getDuration(): float
    {
        return $this->departureDate->diff($arrivalDate);
    }

    public function getDepartueAirport(): string
    {
        return $this->departureAirport;
    }

    public function getArrivalAirport(): string
    {
        return $this->arrivalAirport;
    }
}
