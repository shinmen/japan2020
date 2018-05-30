<?php 

namespace App\Application;

use App\Infrastructure\Overnight\Overnights;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use DatetimeImmutable;

final class OvernightRequestController
{
    /**
     * @var \App\Infrastructure\Overnight\Overnights
     */
    private $overnightOffers;

    public function __construct(Overnights $overnightOffers)
    {
        $this->overnightOffers = $overnightOffers;
    }

    public function __invoke(Request $request)
    {
        $overnightRequestParams = json_decode($request->getContent(), true);
        $offers = $this->overnightOffers->getOvernights(
            new DatetimeImmutable($overnightRequestParams['checkinDate']),
            new DatetimeImmutable($overnightRequestParams['checkoutDate']),
            $overnightRequestParams['guestsNb'],
            $overnightRequestParams['city']
        );
        
        return new JsonResponse($offers);
    }
}
// https://www.airbnb.fr/api/v2/explore_tabs?version=1.2.8&_format=for_explore_search_web&items_per_grid=10&timezone_offset=120&refinements[]=homes&allow_override[]=%27%27&checkin=2018-08-20&checkout=2018-08-27&children=0&infants=0&adults=6&guests=6&location=Tokyo,Japan&_intents=p1&key=d306zoyjsyarp7ifhu67rjxn52tv0t20&currency=EUR&locale=fr