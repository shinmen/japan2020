<?php

namespace App\Domain\Travel\EventStore;

interface EventStoreReadInterface
{
    /**
     * @return EventDescription[]
     */
    public function getEvents(string $streamId): array;
}
