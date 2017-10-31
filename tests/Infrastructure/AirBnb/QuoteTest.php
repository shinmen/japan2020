<?php

namespace App\Tests\Infrastructure\Airbnb;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class QuoteTest extends TestCase
{
    public function testQuoteSchema()
    {
        $client = new Client(['base_uri' => 'https://www.airbnb.fr']);

        $response = $client->request('GET', '/api/v2/explore_tabs', [
                'query' => [
                   'version' => '1.2.8',
                   '_format' => 'for_explore_search_web',
                   'items_per_grid' => 10,
                   'timezone_offset' => 120,
                   'refinements[]' => 'homes',
                   'allow_override[]' => '',
                   'checkin' => '2017-11-20',
                   'checkout' => '2017-11-27',
                   'children' => 0,
                   'infants' => 0,
                   'adults' => 6,
                   'guests' => 6,
                   'location' => 'Tokyo,Japon',
                   '_intents' => 'p1',
                   'key' => 'd306zoyjsyarp7ifhu67rjxn52tv0t20',
                   'currency' => 'EUR',
                   'locale' => 'fr',
                ],
            ]
        );

        var_dump((string)$response->getBody());
    }
}

