<?php

namespace App\Domain\Travel\DTO;

use Datetime;

final class Flight implements \JsonSerializable
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

    /**
     * @var float
     */
    private $duration;

    public function __construct(
        int $flightNumber,
        DateTime $departureDate,
        string $departureAirport,
        Datetime $arrivalDate,
        string $arrivalAirport,
        float $duration
    ) {
        $this->flightNumber = $flightNumber;
        $this->arrivalDate = $arrivalDate;
        $this->departureDate = $departureDate;
        $this->departureAirport = $departureAirport;
        $this->arrivalAirport = $arrivalAirport;
        $this->duration = $duration;
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
        return $this->duration;
    }

    public function getDepartueAirport(): string
    {
        return $this->departureAirport;
    }

    public function getArrivalAirport(): string
    {
        return $this->arrivalAirport;
    }

    public function jsonSerialize()
    {
        return [
            'flightNumber' => $this->flightNumber,
            'arrivalDate' => $this->arrivalDate->format('Y-m-d H:i'),
            'arrivalAirport' => $this->arrivalAirport,
            'departureDate' => $this->departureDate->format('Y-m-d H:i'),
            'departureAirport' => $this->departureAirport,
            'duration' => $this->duration,
        ];
    }
}
