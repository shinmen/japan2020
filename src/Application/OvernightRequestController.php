<?php 

namespace App\Application;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class OvernightRequestController
{
    public function __invoke(Request $request)
    {

        
        return new JsonResponse();
    }
}
// https://www.airbnb.fr/api/v2/explore_tabs?version=1.2.8&_format=for_explore_search_web&items_per_grid=10&timezone_offset=120&refinements[]=homes&allow_override[]=%27%27&checkin=2018-08-20&checkout=2018-08-27&children=0&infants=0&adults=6&guests=6&location=Tokyo,Japan&_intents=p1&key=d306zoyjsyarp7ifhu67rjxn52tv0t20&currency=EUR&locale=fr