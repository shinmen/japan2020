<?php

namespace App\Domain;

final class Repository implements RepositoryInterface
{
    private EventStore $eventStore;

    public function __construct(EventStore $eventStore) :void
    {
        $this->eventStore = $eventStore;
    }

    public function save(AggregateRoot $aggregate, int $expectedVersion)
    {
        $this->eventStore->saveEvents($aggregate->getId(), $aggregate->getUncommitedChanges(), $expectedVersion);
    }

    public function getById($guid, string $aggregateClass)
    {
        $refClassAggr = ReflectionClass($aggregateClass);      
        $aggregate = $refClassAggr->newInstance();
        $history = $this->eventStore->getAggregateHistory($guid);
        $aggregate->replayHistory($history);

        return $aggregate;
    }


}

