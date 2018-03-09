<?php 

namespace App\Domain\Travel\DTO;

final class Airport
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $country;

    public function __construct(string $code, string $city, string $country)
    {
        $this->code = $code;
        $this->city = $city;
        $this->country = $country;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getCountry(): string
    {
        return $this->country;
    }
}