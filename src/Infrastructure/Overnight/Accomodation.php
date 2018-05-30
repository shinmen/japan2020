<?php 

namespace App\Infrastructure\Overnight;

final class Accomodation implements \JsonSerializable
{
    /**
     * @var string
     */
    private $commercialName;

    /**
     * @var string
     */
    private $propertyType;

    /**
     * @var int
     */
    private $capacity;

    /**
     * @var int
     */
    private $bedroomsNb;

    /**
     * @var int
     */
    private $bedNb;

    /**
     * @var int
     */
    private $bathRoomNb;

    /**
     * @var string
     */
    private $city;

    public function __construct(
        string $commercialName,
        string $propertyType,
        int $capacity,
        int $bedroomsNb,
        int $bedNb,
        int $bathRoomNb,
        string $city
    ) {
        $this->commercialName = $commercialName;
        $this->propertyType = $propertyType;
        $this->capacity = $capacity;
        $this->bedroomsNb = $bedroomsNb;
        $this->bedNb = $bedNb;
        $this->bathRoomNb = $bathRoomNb;
        $this->city = $city;
    }

    public function jsonSerialize(): array
    {
        return [
            'commercialName' => $this->commercialName,
            'propertyType' => $this->propertyType,
            'capacity' => $this->capacity,
            'bedroomsNb' => $this->bedroomsNb,
            'bedNb' => $this->bedNb,
            'bathRoomNb' => $this->bathRoomNb,
            'city' => $this->city,
        ]; 
    }

    public function getCommercialName(): string
    {
        return $this->commercialName;
    }

    public function getPropertyType(): string
    {
        return $this->propertyType;
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function getBedroomsNb(): int
    {
        return $this->bedroomsNb;
    }

    public function getBedNb(): int
    {
        return $this->bedNb;
    }

    public function getBathRoomNb(): int
    {
        return $this->bathRoomNb;
    }

    public function getCity(): string
    {
        return $this->city;
    }
}
