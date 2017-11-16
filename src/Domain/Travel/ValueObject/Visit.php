<?php

namespace App\Domain\Travel\ValueObject;

use Datetime;

final class Visit
{
    public function __construct(Datetime $visitDate, string $city)
    {
        $this->visitDate = $visitDate;
        $this->city = $city;   
    }

    public function getVisitDate(): Datetime
    {
        return $this->visitDate;
    }

    public function getCity(): string
    {
        return $this->city;
    }
}

