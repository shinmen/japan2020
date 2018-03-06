<?php

namespace App\Tests\Infrastructure\Flight;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class QuoteTest extends KernelTestCase
{
    public function setUp()
    {
        static::bootKernel();
    }

    public function testQuoteSchema()
    {
        $container = static::$kernel->getContainer();
        $client = new Client(['base_uri' => 'https://api-dev.fareportallabs.com']);

        try {
            $response = $client->request('POST', '/air/api/search/searchflightavailability', 
                [
                    'auth' => ['login', 'password'],
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

