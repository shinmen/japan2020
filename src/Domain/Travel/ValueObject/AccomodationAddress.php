<?php

namespace App\Domain\Travel\ValueObject;

final class AccomodationAddress
{
    private $name;

    private $address;

    private $district;

    private $city;

    public function __construct(string $name, string $address, string $district, string $city)
    {
        $this->name = $name;
        $this->address = $address;
        $this->district = $district;
        $this->city = $city;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getDistrict(): string
    {
        return $this->district;
    }

    public function getCity(): string
    {
        return $this->city;
    }
}

