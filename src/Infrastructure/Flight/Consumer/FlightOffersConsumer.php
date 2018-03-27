<?php

namespace App\Infrastructure\Flight\Consumer;

use MongoDB\Client;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

final class FlightOffersConsumer implements ConsumerInterface
{
    const NACK = false;
    const ACK = true;
    /**
     * @var Client
     */
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->client->selectDatabase('japan2020');
    }
    
    public function execute(AMQPMessage $msg)
    {
        try {
            $flightPlan = unserialize($msg->getBody());
            $json = json_encode($flightPlan);
            $collection = $this->client->japan2020->flights_fares;
            $collection->insertOne(json_decode($json, true));

            return self::ACK;
        } catch(\Exception $e) {
            return self::NACK;
        }
    }
}
