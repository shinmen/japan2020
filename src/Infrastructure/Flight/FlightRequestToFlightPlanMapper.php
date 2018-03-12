<?php

namespace App\Infrastructure\Flight;

use App\Domain\Travel\DTO\Flight;
use App\Domain\Travel\DTO\FlightPlan;
use App\Domain\Travel\DTO\TripInfo;
use Datetime;

final class FlightRequestToFlightPlanMapper
{
    const MAX_RESULT = 30;

    public function buildFlightPlans(array $content)
    {
        $search = $content['FlightResponse']['FpSearch_AirLowFaresRS'];
        $currency = $search['Currency']['CurrencyCode'];
        $originDestinationOptions = $search['OriginDestinationOptions'];

        $outboundOptions = $this->mapGoingFlightInfo($originDestinationOptions['OutBoundOptions']['OutBoundOption']);
        $inboundOptions = $this->mapReturnFlightInfo($originDestinationOptions['InBoundOptions']['InBoundOption']);

        return $this->mapFlightPlans(
            $search['SegmentReference']['RefDetails'],
            $outboundOptions,
            $inboundOptions
        );
    }

    private function mapFlightPlans(array $flighDetails, array $outboundOptions, array $inboundOptions): array
    {
        $i = 0;
        $flightRequests = [];
        while ($i <= self::MAX_RESULT) {
            $outBoundId = $flighDetails[$i]['OutBoundOptionId'][0];
            $goingFlightInfo = $outboundOptions[$outBoundId];
            $inBoundId = $flighDetails[$i]['InBoundOptionId'][0];
            $returnFlightInfo = $inboundOptions[$inBoundId];

            $totalPerAdultFare = $flighDetails[$i]['PTC_FareBreakdown']['Adult']['TotalAdultFare'];
            $flightRequest = new FlightPlan($goingFlightInfo, $returnFlightInfo, $totalPerAdultFare);
            $flightRequests[] = $flightRequest;
            $i++;
        }

        return $flightRequests;
    }

    private function mapGoingFlightInfo(array $outboundOptions): array
    {
        $goingTrip = [];
        foreach ($outboundOptions as $option) {
            $goingTrip = $this->mapFlightOption($option, $goingTrip);
        }

        return $goingTrip;
    }

    private function mapReturnFlightInfo(array $inboundOptions): array
    {
        $returnFlightTrip = [];
        foreach ($inboundOptions as $option) {
            $returnFlightTrip = $this->mapFlightOption($option, $returnFlightTrip);
        }   

        return $returnFlightTrip;
    }

    
    private function mapFlightOption(array $option, array $flightInfos): array
    {
        $firstFlight = $option['FlightSegment'][0];
        $companyName = $firstFlight['MarketingAirline']['Code'];
        $duration = $firstFlight['FlightDuration'];
        $flights = $this->mapFlights($option['FlightSegment']);

        $trip = new TripInfo($duration, $companyName, $flights);
        $flightInfos[$option['Segmentid']] = $trip;

        return $flightInfos;
    }

    /**
     * @return Flight[]
     */
    private function mapFlights(array $flightSegments): array
    {
        $flights = [];
        foreach ($flightSegments as $flight) {
            $flights[] = new Flight(
                $flight['FlightNumber'], 
                $this->extractTime($flight['DepartureDateTime']),
                $flight['DepartureAirport']['LocationCode'],
                $this->extractTime($flight['ArrivalDateTime']),
                $flight['ArrivalAirport']['LocationCode']
            );
        }

        return $flights;
    }

    private function extractTime(string $date): Datetime
    {
        preg_match('/(\d+)(\D+)(\d+)T(.+)/', $date, $parts);
        unset($parts[0]);

        return new Datetime(sprintf(
                '%d %s %d %s', ...$parts
            )
        );
    }
}
