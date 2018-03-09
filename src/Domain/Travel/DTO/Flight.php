<?php

namespace App\Domain\Travel\DTO;

use Datetime;

final class Flight
{
    /**
     * @var int
     */
    private $flightNumber;

    /**
     * @var string
     */
    private $departureAirport;

    /**
     * @var Datetime
     */
    private $departureDate;

    /**
     * @var string
     */
    private $arrivalAirport;

    /**
     * @var Datetime
     */
    private $arrivalDate;

    public function __construct(
        int $flightNumber,
        DateTime $departureDate,
        string $departureAirport,
        Datetime $arrivalDate,
        string $arrivalAirport
    ) {
        $this->flightNumber = $flightNumber;
        $this->arrivalDate = $arrivalDate;
        $this->departureDate = $departureDate;
        $this->departureAirport = $departureAirport;
        $this->arrivalAirport = $arrivalAirport;
    }

    public function getFlightNumber(): int
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
