<?php 

namespace App\Domain\Travel\DTO;

final class FlightTripDTO
{
    private $flightDuration;
    private $flights;
    private $stopNb;

    public function __construct(float $flightDuration, array $flights)
    {
        $this->flightDuration = $flightDuration;
        $this->flights = $flights;
        $this->stopNb = count($flights) - 1;
    }

    public function getFlightDuration(): float
    {
        return $this->flightDuration;
    }

    public function getFlights(): array
    {
        return $this->flights;
    }

    public function getStopNb(): int
    {
        return $this->stopNb;
    }
}
