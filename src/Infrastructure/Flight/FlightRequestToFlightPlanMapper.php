<?php

namespace App\Infrastructure\Flight;

use App\Domain\Travel\DTO\Flight;
use App\Domain\Travel\DTO\FlightPlan;
use App\Domain\Travel\DTO\TripInfo;
use Datetime;

final class FlightRequestToFlightPlanMapper
{
    const MAX_RESULT = 30;
    const USD_TO_EUR = 0.835;

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

    private function mapFlightPlans(array $flightDetails, array $outboundOptions, array $inboundOptions): array
    {
        $i = 0;
        $flightPlans = [];
        while ($i <= $this->limitResult(count($flightDetails))) {
            $outBoundId = $flightDetails[$i]['OutBoundOptionId'][0];
            $goingFlightInfo = $outboundOptions[$outBoundId];
            $inBoundId = $flightDetails[$i]['InBoundOptionId'][0];
            $returnFlightInfo = $inboundOptions[$inBoundId];

            $totalPerAdultFare = $flightDetails[$i]['PTC_FareBreakdown']['Adult']['TotalAdultFare'] * self::USD_TO_EUR;
            $flightPlan = new FlightPlan($goingFlightInfo, $returnFlightInfo, $totalPerAdultFare);
            $flightPlans[] = $flightPlan;
            $i++;
        }

        return $flightPlans;
    }

    private function limitResult(int $flightOffersNb): int
    {
        return $flightOffersNb >= self::MAX_RESULT ? self::MAX_RESULT : $flightOffersNb -1;
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
        $companyName = $firstFlight['OperatedByAirline']['CompanyText'];
        $duration = $this->isDurationSameOnEachFlight($option['FlightSegment']) ?
            $firstFlight['FlightDuration']:
            $this->addAllFlightDuration($option['FlightSegment']) ;
        $flights = $this->mapFlights($option['FlightSegment']);

        $trip = new TripInfo($duration, $companyName, $flights);
        $flightInfos[$option['Segmentid']] = $trip;

        return $flightInfos;
    }

    /**
     * Due to a misbuilt flight api, sometimes each flight duration equals to total trip duration
     */
    private function isDurationSameOnEachFlight(array $flightSegments): bool
    {
        return  $this->addAllFlightDuration($flightSegments) / count($flightSegments) == 
                $flightSegments[0]['FlightDuration'];
    }

    private function addAllFlightDuration(array $flightSegments): float
    {
        return array_sum(array_column($flightSegments, 'FlightDuration'));
    }

    /**
     * @return Flight[]
     */
    private function mapFlights(array $flightSegments): array
    {
        $flights = [];
        foreach ($flightSegments as $flight) {
            $flightDuration = $this->isDurationSameOnEachFlight($flightSegments) ?
                $flight['FlightDuration'] / count($flightSegments) :
                $flight['FlightDuration'];

            $flights[] = new Flight(
                $flight['FlightNumber'], 
                $this->extractTime($flight['DepartureDateTime']),
                $flight['DepartureAirport']['LocationCode'],
                $this->extractTime($flight['ArrivalDateTime']),
                $flight['ArrivalAirport']['LocationCode'],
                $flightDuration
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
