<?php

namespace App\Tests\Infrastructure\EventStore;

use App\Infrastructure\EventStore\EventDescriptionDataTransformer;
use App\Infrastructure\EventStore\EventStoreReadStream;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use PicoFeed\Config\Config;
use PicoFeed\PicoFeedException;
use PicoFeed\Reader\Reader;

class EventStoreStreamReaderTest extends TestCase
{
    public function testReadTestStream()
    {
        $reader = new EventStoreReadStream(
            new Reader(),
            new Config(),
            new EventDescriptionDataTransformer(),
            'admin',
            'changeit',
            'http://127.0.0.1:2113'
        );
        $content = $reader->getEvents('$projections-$master');
        var_dump($content);
    }
}

