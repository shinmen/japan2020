<?php 

namespace App\Domain\Travel\DTO;

use App\Domain\Travel\DTO\FlightTripDTO;

final class FlightPlanDTO
{
    private $adultFare;
    private $goingTrip;
    private $returnTrip;

    public function __construct(float $adultFare, FlightTripDTO $goingTrip, FlightTripDTO $returnTrip)
    {
        $this->adultFare = $adultFare;
        $this->goingTrip = $goingTrip;
        $this->returnTrip = $returnTrip;
    }


    public function getAdultFare(): float
    {
        return $this->adultFare;
    }

    public function getGoingTrip(): FlightTripDTO
    {
        return $this->goingTrip;
    }

    public function getReturnTrip(): FlightTripDTO
    {
        return $this->returnTrip;
    }
}
