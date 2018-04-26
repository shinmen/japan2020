<?php 

namespace App\Domain\Travel\DTO;

final class Airport implements \JsonSerializable
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $city;

    /**
     * @var string
     */
    private $country;

    public function __construct(string $code, string $name,string $city, string $country)
    {
        $this->code = $code;
        $this->name = $name;
        $this->city = $city;
        $this->country = $country;
    }

    public function getName()
    {
        return $this->name;
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

    public function jsonSerialize()
    {
        return [
            'name' => $this->name,
            'code' => $this->code,
            'city' => $this->city,
            'country' => $this->country,
        ];
    }
}