<?php

namespace App\Infrastructure\Flight;

final class TripRequest
{
    private $originAirportCode;
    private $arrivalAirportCode;
    private $departureDatetime;

    public function __construct(string $originAirportCode, string $arrivalAirportCode, Datetime $departureDatetime)
    {
        $this->originAirportCode = $originAirportCode;
        $this->arrivalAirportCode = $arrivalAirportCode;
        $this->departureDatetime = $departureDatetime;
    }

    public function getOriginAirportCode(): string
    {
        return $this->originAirportCode;
    }

    public function getArrivalAirportCode(): string
    {
        return $this->arrivalAirportCode;
    }

    public function getDepartureDatetime(): Datetime
    {
        return $this->departureDatetime;
    }
}
