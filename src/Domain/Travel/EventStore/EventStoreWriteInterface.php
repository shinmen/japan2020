<?php

namespace App\Domain\Travel\EventStore;

use Psr\Http\Message\ResponseInterface;

interface EventStoreWriteInterface
{
    public function writeBatchEvent(string $streamId, array $events): ResponseInterface;
}
