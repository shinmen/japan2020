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
                        'Origin' => $this->goingTrip->getOriginAirportCode(),
                        'Destination' => $this->goingTrip->getArrivalAirportCode(),
                        'DepartureDate' => $this->goingTrip->getDepartureDatetime()->format('Y-m-d'),
                        'DepartureTime' => $this->goingTrip->getDepartureDatetime()->format('Hi'),
                    ],
                    [
                        'Origin' => $this->returnTrip->getOriginAirportCode(),
                        'Destination' => $this->returnTrip->getArrivalAirportCode(),
                        'DepartureDate' => $this->returnTrip->getDepartureDatetime()->format('Y-m-d'),
                        'DepartureTime' => $this->returnTrip->getDepartureDatetime()->format('Hi'),
                    ]
                ],
                'SearchAlternateDates' => false,
            ],
        ];
    }
}
