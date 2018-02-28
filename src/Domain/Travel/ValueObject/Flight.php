<?php

namespace Domain\Travel\ValueObject;

use Datetime;

final class Flight
{
    private $flightNumber;

    private $company;

    private $arrivalDate;

    private $departureDate;

    private $departureCity;

    private $arrivalCity;

    public function __construct(
        int $flightNumber,
        string $company,
        DateTime $arrivalDate,
        Datetime $departureDate
    ) {
        $this->flightNumber = $flightNumber;
        $this->company = $company;
        $this->arrivalDate = $arrivalDate;
        $this->departureDate = $departureDate;
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
        return $this->departureDate->diff($arrivalDate);
    }

    public function getDepartueCity(): string
    {

    }

    public function getArrivalCity(): string
    {
        
    }
}
