<?php

namespace App\Tests\Infrastructure\Flight;

use App\Domain\Travel\ValueObject\Flight;
use App\Infrastructure\Flight\TripInfo;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use \Datetime;

class QuoteTest extends TestCase
{
    
    public function testQuoteSchema()
    {
        $path = dirname(__DIR__).'/../data/';
        $content = json_decode(file_get_contents($path.'flight_response.txt'), true);
        
        $search = $content['FlightResponse']['FpSearch_AirLowFaresRS'];
        $currency = $search['Currency']['CurrencyCode'];
        $outboundOptions = [];
        foreach ($search['OriginDestinationOptions']['OutBoundOptions']['OutBoundOption'] as $option) {
            $firstFlight = $option['FlightSegment'][0];
            $companyName = $firstFlight['MarketingAirline']['Code'];
            $duration = $firstFlight['FlightDuration'];
            $flights = [];
            foreach ($option['FlightSegment'] as $flight) {
                $flights[] = new Flight(
                    $flight['FlightNumber'], 
                    $this->extractTime($flight['DepartureDateTime']),
                    $this->extractTime($flight['ArrivalDateTime']),
                    $flight['DepartureAirport']['LocationCode'],
                    $flight['ArrivalAirport']['LocationCode']
                );
            }
            $trip = new TripInfo($duration, $companyName, $flights);
            $outboundOptions[$option['Segmentid']] = $trip;
        }

        var_dump($outboundOptions);
    }

    private function extractTime(string $date)
    {
        preg_match('/(\d+)(\D+)(\d+)T(.+)/', $date, $parts);
        unset($parts[0]);
        return new Datetime(sprintf(
                '%d %s %d %s', ...$parts
            )
        );
     }
}

