<?php

namespace Domain\Travel\ValueObject;

use Datetime;

final class Flight
{
    private $flightNumber;

    private $company;

    private $arrivalDate;

    private $departureDate;

    private $rate;

    public function __construct(
        int $flightNumber,
        string $company,
        DateTime $arrivalDate,
        Datetime $departureDate,
        float $rate
    ) {
        $this->flightNumber = $flightNumber;
        $this->company = $company;
        $this->arrivalDate = $arrivalDate;
        $this->departureDate = $departureDate;
        $this->rate = $rate;
    }

    public function getFlightNumber()
    {
        return $this->flightNumber;
    }

    public function getCompanyName()
    {
        return $this->company;
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
        return ;
    }

    public function getRate(): float
    {
        return $this->rate;
    }
}
