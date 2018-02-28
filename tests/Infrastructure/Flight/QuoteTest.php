<?php

namespace App\Tests\Infrastructure\Flight;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class QuoteTest extends TestCase
{
    public function testQuoteSchema()
    {
        $client = new Client(['base_uri' => 'https://api-dev.fareportallabs.com']);

        try {
            $response = $client->request('POST', '/air/api/search/searchflightavailability', 
                [
                    'auth' => ['julotrash@gmail.com', 'juFFF83C64'],
                    //'headers' => ['Accept-Encoding' => 'application/gzip'],
                    'json' => [
                        'ResponseVersion' => 'VERSION41',
                        'FlightSearchRequest' => [
                            'Adults' => 1,
                            'TypeOfTrip' => 'ROUNDTRIP',
                            'ClassOfService' => 'ECONOMY',
                            'SegmentDetails' => [
                                [
                                    'Origin' => 'NYC',
                                    'Destination' => 'LON',
                                    'DepartureDate' => '2018-05-02',
                                    'DepartureTime' => '1200',
                                ],
                                [
                                    'Origin' => 'LON',
                                    'Destination' => 'NYC',
                                    'DepartureDate' => '2018-05-05',
                                    'DepartureTime' => '1200',
                                ]
                            ],
                            'SearchAlternateDates' => false,
                        ]
                    ],
                ]
            );

        //var_dump(file_put_contents(dirname('../../var/test.html')));
        var_dump((string)$response->getBody());
        } catch(\Exception $e ){
            print_r($e->getMessage());
        }

    }
}

