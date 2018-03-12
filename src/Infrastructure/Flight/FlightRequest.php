<?php 

namespace App\Infrastructure\Flight;

final class FlightRequest
{
    const VERSION = 'VERSION41';

    private $goingTrip;
    private $returnTrip;

    public function __construct(TripRequest $goingTrip, TripRequest $returnTrip)
    {
        $this->goingTrip = $goingTrip;
        $this->returnTrip = $returnTrip;
    }

    public function buildRequest()
    {
        return [
            'ResponseVersion' => self::VERSION,
            'FlightSearchRequest' => [
                'Adults' => 1,
                'TypeOfTrip' => 'ROUNDTRIP',
                'ClassOfService' => 'ECONOMY',
                'SegmentDetails' => [
                    [
                        'Origin' => $goingTrip->getOriginAirportCode(),
                        'Destination' => $goingTrip->getArrivalAirportCode(),
                        'DepartureDate' => $goingTrip->getDepartureDatetime()->format('Y-m-d'),
                        'DepartureTime' => $goingTrip->getDepartureDatetime()->format('Hi'),
                    ],
                    [
                        'Origin' => $returnTrip->getOriginAirportCode(),
                        'Destination' => $returnTrip->getArrivalAirportCode(),
                        'DepartureDate' => $returnTrip->getDepartureDatetime()->format('Y-m-d'),
                        'DepartureTime' => $returnTrip->getDepartureDatetime()->format('Hi'),
                    ]
                ],
                'SearchAlternateDates' => false,
            ],
        ];
    }
}
