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
        
    }
}

