<?php

namespace App\Domain\Travel\ValueObject;

final class RailPassPackage
{
    private $packageName;

    private $price;

    private $startDate;

    private $endDate;

    public function __construct(string $packageName, float $price, Datetime $startDate, Datetime $endDate)
    {
        $this->packageName = $packageName;
        $this->price = $price;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function getPackage(): string
    {
        return $this->packageName;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    public function getEndDate(): Datetime
    {
        return $this->endDate;
    }
}

