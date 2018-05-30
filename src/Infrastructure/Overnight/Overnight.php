<?php 

namespace App\Infrastructure\Overnight;

use App\Infrastructure\Overnight\Accomodation;
use App\Infrastructure\Overnight\Geolocation;

final class Overnight implements \JsonSerializable
{
    /**
     * @var \App\Infrastructure\Overnight\Accomodation
     */
    private $accomodation;

    /**
     * @var \App\Infrastructure\Overnight\Geolocation
     */
    private $geolocation;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $pricePerPax;

    /**
     * @var float
     */
    private $weekReduction;

    /**
     * @var string
     */
    private $thumbnailUrl;

    /**
     * @var [string]
     */
    private $otherThumbnails;

    public function __construct(
        Accomodation $accomodation,
        Geolocation $geolocation,
        float $pricePerPax,
        float $weekReduction,
        string $thumbnailUrl,
        array $otherThumbnails
    ) {
        $this->accomodation = $accomodation;
        $this->geolocation = $geolocation;
        $this->pricePerPax = $pricePerPax;
        $this->weekReduction = $weekReduction;
        $this->thumbnailUrl = $thumbnailUrl;
        $this->otherThumbnails = $otherThumbnails;
    }

    public function jsonSerialize():array
    {
        return [
            'accomodation' => $this->accomodation,
            'geolocation' => $this->geolocation,
            'pricePerPax' => $this->pricePerPax,
            'weekReduction' => $this->weekReduction,
            'thumbnailUrl' => $this->thumbnailUrl,
            'otherThumbnails' => $this->otherThumbnails,
        ];
    }

    public function getThumbnailUrl(): string
    {
        return $this->thumbnailUrl;
    }

    public function getAccomodation(): Accomodation
    {
        return $this->accomodation;
    }

    public function getGeolocation(): Geolocation
    {
        return $this->geolocation;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPricePerPax(): float
    {
        return $this->pricePerPax;
    }

    public function getWeekReduction(): float
    {
        return $this->weekReduction;
    }

    public function getOtherThumbnails(): array
    {
        return $this->otherThumbnails;
    }
}
