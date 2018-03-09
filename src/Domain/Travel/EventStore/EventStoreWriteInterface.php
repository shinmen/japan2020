<?php

namespace App\Domain\Travel\EventStore;

use Psr\Http\Message\ResponseInterface;

interface EventStoreWriteInterface
{
    public function writeBatchEvent(array $events): ResponseInterface;
}
