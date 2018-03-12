<?php

namespace App\Infrastructure\Flight\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

final class FlightOffersConsumer implements ConsumerInterface
{
    const NACK = false;
    public function execute(AMQPMessage $msg)
    {
        return self::NACK;
    }
}
