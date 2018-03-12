<?php

namespace App\Domain\Travel\DTO;

use App\Domain\Travel\DTO\TripInfo;

class FlightPlan
{
    /**
     * @var TripInfo
     */
    private $goingFlightInfo;

    /**
     * @var TripInfo
     */
    private $returnFlightInfo;

    /**
     * @var float
     */
    private $totalRatePerAdulte;

    public function __construct(TripInfo $goingFlightInfo, TripInfo $returnFlightInfo, float $totalRatePerAdulte)
    {   
        $this->goingFlightInfo = $goingFlightInfo;
        $this->returnFlightInfo = $returnFlightInfo;
        $this->totalRatePerAdulte = $totalRatePerAdulte;
    }

    public function getGoingFlightInfo(): TripInfo
    {
        return $this->goingFlightInfo;
    }

    public function getReturnFlightInfo(): TripInfo
    {
        return $this->returnFlightInfo;
    }

    public function getTotalRatePerAdulte(): float
    {
        return $this->totalRatePerAdulte;
    }
}
