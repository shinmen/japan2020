<?php 

namespace App\Infrastructure\Overnight;

use App\Infrastructure\Overnight\Accomodation;
use App\Infrastructure\Overnight\Geolocation;
use App\Infrastructure\Overnight\Overnight;

final class OvernightRequestToOvernightMapper
{
    public function buildOvernights(int $guestNb, array $content): array
    {
        if (empty($content['explore_tabs'][0]['sections'][0]['listings'])) {
            return [];
        }

        $listing = $content['explore_tabs'][0]['sections'][0]['listings'];
        $accomodationOffers = [];
        foreach ($listing as $accomodation) {
            $accomodationOffers[] = new Overnight(
                $this->buildAccomodationDetails($accomodation),
                $this->buildGeolocation($accomodation),
                $this->computePricePerPax($accomodation, $guestNb),
                $accomodation['pricing_quote']['weekly_price_factor'],
                $accomodation['listing']['picture_url'],
                $this->pickOtherThumbnails($accomodation)
            );
        }

        return $accomodationOffers;
    }

    private function buildAccomodationDetails(array $accomodation): Accomodation
    {
        $detail = $accomodation['listing'];
        return new Accomodation(
            $detail['name'],
            $detail['room_and_property_type'],
            $detail['person_capacity'],
            $detail['bedrooms'],
            $detail['beds'],
            $detail['bathrooms'],
            $detail['city']
        );
    }

    private function buildGeolocation(array $accomodation): Geolocation
    {
        return Geolocation::pinpoint(
            $accomodation['listing']['lat'],
            $accomodation['listing']['lng']
        );
    }

    private function computePricePerPax(array $accomodation, int $guestNb): float
    {
        return $accomodation['pricing_quote']['price']['total']['amount'] / $guestNb;
    }

    private function pickOtherThumbnails(array $accomodation): array
    {
        return array_slice($accomodation['listing']['picture_urls'], 0, 5);
    }
}
