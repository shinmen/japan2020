<?php

namespace App\Tests\Infrastructure\Flight;

use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Symfony\Component\Finder\Finder;

class QuoteTest extends TestCase
{
    
    public function testQuoteSchema()
    {
        $path = dirname(__DIR__).'/../data/';
        $content = json_decode(file_get_contents($path.'flight_response.txt'), true);
        
        

    }
}

