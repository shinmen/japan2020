<?php

namespace App\Domain\Travel\EventStore;

interface EventStoreReadInterface
{
    public function getEvents(string $streamId): array;
}
