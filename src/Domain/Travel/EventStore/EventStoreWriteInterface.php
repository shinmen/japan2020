<?php

namespace App\Domain\Travel\EventStore;

use Psr\Http\Message\ResponseInterface;

interface EventStoreWriteInterface
{
    /**
     * @param  App\Domain\Travel\Model\EventDescription[]  $events
     */
    public function writeBatchEvent(string $streamId, array $events): ResponseInterface;
}
