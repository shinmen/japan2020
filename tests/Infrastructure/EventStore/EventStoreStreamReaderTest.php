<?php

namespace App\Tests\Infrastructure\EventStore;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use PicoFeed\Reader\Reader;
use PicoFeed\Config\Config;
use PicoFeed\PicoFeedException;

class EventStoreStreamReaderTest extends TestCase
{
    const ACCEPT = 'application/xml';

    public function testReadTestStream()
    {
        try {
                $config = new Config();
                //$config->setAdditionalCurlOptions([CURLOPT_HTTPHEADER => ['Accept: application/vnd.eventstore.atom+json']]);
                $config->setAdditionalCurlOptions([CURLOPT_HTTPHEADER => ['Accept: '.self::ACCEPT]]);
                $reader = new Reader($config);

                // Return a resource
                $resource = $reader->download('http://127.0.0.1:2113/streams/$stream_test', '', '', 'admin', 'changeit');
                //var_dump($resource->getContent());
                
                // Return the right parser instance according to the feed format
                $parser = $reader->getParser(
                    $resource->getUrl(),
                    $resource->getContent(),
                    $resource->getEncoding()
                );
                
                // // Return a Feed object
                $feed = $parser->execute();
                
                // // Print the feed properties with the magic method __toString()
                // var_dump(count($feed->getItems()));
                $config = new Config();
                $config->setAdditionalCurlOptions([CURLOPT_HTTPHEADER => ['Accept: application/vnd.eventstore.atom+json']]);
                //$config->setAdditionalCurlOptions([CURLOPT_HTTPHEADER => ['Accept: application/json']]);
                $reader = new Reader($config);

                foreach ($feed->getItems() as $key => $value) {
                    //var_dump("$value");
                    $resource = $reader->download($value->getUrl(), '', '', 'admin', 'changeit');
                    //var_dump($resource);
                    var_dump(json_decode($resource->getContent(), true));
                }
                //var_dump($feed->getItems());
         } catch (PicoFeedException $e) {
             //var_dump($e->getMessage());
              // Do Something...
         }
    }
}

