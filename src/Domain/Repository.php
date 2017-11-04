<?php

namespace App\Domain;

use App\Domain\AggregateRoot;
use App\Domain\EventStore;
use App\Domain\RepositoryInterface;

class Repository implements RepositoryInterface
{
    private $eventStore;

    public function __construct(EventStore $eventStore)
    {
        $this->eventStore = $eventStore;
    }

    public function save(AggregateRoot $aggregate, int $expectedVersion)
    {
        $this->eventStore->saveEvents($aggregate->getId(), $aggregate->getUncommitedChanges(), $expectedVersion);
    }

    public function getById($guid, string $aggregateClass)
    {
        $refClassAggr = new \ReflectionClass($aggregateClass);      
        $aggregate = $refClassAggr->newInstance();
        $history = $this->eventStore->getAggregateHistory($guid);
        $aggregate->replayHistory($history);

        return $aggregate;
    }


}

