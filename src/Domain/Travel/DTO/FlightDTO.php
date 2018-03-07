<?php 

namespace App\Domain\Travel\DTO;

use Datetime;

final class FlightDTO
{
    private $airportOrigin;
    private $airportDestination;
    private $companyName;
    private $flightNumber;
    private $departureTime;
    private $arrivalTime;

    public function __construct(
        string $airportOrigin,
        Datetime $departureTime,
        string $airportDestination,
        Datetime $arrivalTime,
        string $companyName,
        int $flightNumber
    ) {
        $this->airportOrigin = $airportOrigin;
        $this->departureTime = $departureTime;
        $this->airportDestination = $airportDestination;
        $this->arrivalTime = $arrivalTime;
        $this->companyName = $companyName;
        $this->flightNumber = $flightNumber;
    }


    public function getAirportOrigin(): string
    {
        return $this->airportOrigin;
    }

    public function getAirportDestination(): string
    {
        return $this->airportDestination;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function getFlightNumber(): int
    {
        return $this->flightNumber;
    }

    public function getDepartureTime(): Datetime
    {
        return $this->departureTime;
    }

    public function getArrivalTime(): Datetime
    {
        return $this->arrivalTime;
    }
}
