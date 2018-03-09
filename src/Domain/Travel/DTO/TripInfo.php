<?php

namespace App\Domain\Travel\DTO;

final class TripInfo
{
    /**
     * @var float
     */
    private $duration;

    /**
     * @var string
     */
    private $companyName;

    /**
     * @var array
     */
    private $flights;

    public function __construct(float $duration, string $companyName, array $flights)
    {
        $this->duration = $duration;
        $this->companyName = $companyName;
        $this->flights = $flights;
    }

    /**
     * @return float
     */
    public function getDuration(): float
    {
        return $this->duration;
    }

    /**
     * @return string
     */
    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    /**
     * @return array
     */
    public function getFlights(): array
    {
        return $this->flights;
    }
}
