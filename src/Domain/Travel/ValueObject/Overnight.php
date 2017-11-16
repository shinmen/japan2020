<?php

namespace App\Domain\Travel\ValueObject;

use Datetime;
use App\Domain\Travel\ValueObject\AccomodationAddress;

final class Overnight
{
    private $address;

    private $stayDate;

    private $rate;

    private $district;

    private $city;

    public function __construct(AccomodationAddress $address, Datetime $stayDate, float $rate)
    {
        $this->address = $address;
        $this->stayDate = $stayDate;
        $this->rate = $rate;
    }

    public function getAddress(): AccomodationAddress
    {
        return $this->address;
    }

    public function getStayDate(): Datetime
    {
        return $this->stayDate;
    }

    public function getRate(): float
    {
        return $this->rate;
    }
}

