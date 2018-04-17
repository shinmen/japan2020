<?php

namespace Tests\App\Tests\Infrastructure\Flight;

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
        $content = json_decode(file_get_contents($path.'flight_response_incomplete.txt'), true);

        $mapper = new FlightRequestToFlightPlanMapper();
        $flightRequests = $mapper->buildFlightPlans($content);

        var_dump($flightRequests);
    }
}

