<?php 

namespace App\Infrastructure\Overnight;

final class OvernightRequestToOvernightMapper
{
    public function buildOvernights(array $content): array
    {
        if (empty($content['explore_tabs'][0]['sections'][0]['listings'])) {
            return [];
        }

        $listing = $content['explore_tabs'][0]['sections'][0]['listings'];
        foreach ($listing as $accomodation) {
            
        }


    }
}
