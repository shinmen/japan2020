<?php

namespace App\Domain\Travel;

use App\Domain\EventCollection;

interface EventStore
{
    public function saveEvents(string $uid, array $changes, int $expectedVersion) :void;

    public function getAggregateHistory(string $uid) :EventCollection;
}

