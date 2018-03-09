<?php 

namespace App\Infrastructure\Flight;

use App\Infrastructure\Flight\TripInfo;

class FlightRequest
{
    private $goingFlightInfo;
    private $returnFlightInfo;
    private $totalRatePerAdulte;

    public function __construct(TripInfo $goingFlightInfo, TripInfo $returnFlightInfo, float $totalRatePerAdulte)
    {   
        $this->goingFlightInfo = $goingFlightInfo;
        $this->returnFlightInfo = $returnFlightInfo;
        $this->totalRatePerAdulte = $totalRatePerAdulte;
    }
}
