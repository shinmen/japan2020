<?php

namespace App\Tests\Infrastructure\Flight;

use App\Domain\Travel\DTO\Flight;
use App\Domain\Travel\DTO\FlightPlan;
use App\Domain\Travel\DTO\TripInfo;
use App\Infrastructure\Flight\FlightRequestToFlightPlanMapper;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use \Datetime;

class QuoteTest extends TestCase
{
    
    public function testQuoteSchema()
    {
        $path = dirname(__DIR__).'/../data/';
        $content = json_decode(file_get_contents($path.'flight_response.txt'), true);

        $mapper = new FlightRequestToFlightPlanMapper();
        $flightRequests = $mapper->buildFlightPlans($content);
        
        // $search = $content['FlightResponse']['FpSearch_AirLowFaresRS'];
        // $currency = $search['Currency']['CurrencyCode'];
        // $outboundOptions = [];
        // foreach ($search['OriginDestinationOptions']['OutBoundOptions']['OutBoundOption'] as $option) {
        //     $outboundOptions = $this->getFlightOption($option, $outboundOptions);
        // }

        // $inboundOptions = [];
        // foreach ($search['OriginDestinationOptions']['InBoundOptions']['InBoundOption'] as $option) {
        //     $inboundOptions = $this->getFlightOption($option, $inboundOptions);
        // }

        // $i = 0;
        // $flightRequests = [];
        // $refs = $search['SegmentReference']['RefDetails'];
        // while ($i <= 30) {
        //     $outBoundId = $refs[$i]['OutBoundOptionId'][0];
        //     $goingFlightInfo = $outboundOptions[$outBoundId];
        //     $inBoundId = $refs[$i]['InBoundOptionId'][0];
        //     $returnFlightInfo = $inboundOptions[$inBoundId];

        //     $totalPerAdultFare = $refs[$i]['PTC_FareBreakdown']['Adult']['TotalAdultFare'];
        //     $flightRequest = new FlightPlan($goingFlightInfo, $returnFlightInfo, $totalPerAdultFare);
        //     $flightRequests[] = $flightRequest;
        //     $i++;
        // }

        var_dump($flightRequests);

        //var_dump(array_key_exists('ET673H10ET704H10ET', $inboundOptions));
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

    private function getFlightOption(array $option, array $flightInfos)
    {
        $firstFlight = $option['FlightSegment'][0];
        $companyName = $firstFlight['MarketingAirline']['Code'];
        $duration = $firstFlight['FlightDuration'];
        $flights = [];
        foreach ($option['FlightSegment'] as $flight) {
            $flights[] = new Flight(
                $flight['FlightNumber'], 
                $this->extractTime($flight['DepartureDateTime']),
                $flight['DepartureAirport']['LocationCode'],
                $this->extractTime($flight['ArrivalDateTime']),
                $flight['ArrivalAirport']['LocationCode']
            );
        }
        $trip = new TripInfo($duration, $companyName, $flights);
        $flightInfos[$option['Segmentid']] = $trip;

        return $flightInfos;
    }
}

