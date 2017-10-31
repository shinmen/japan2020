<?php

namespace App\Domain;

interface RepositoryInterface
{
    public function save(AggregateRoot $aggregate, int $expectedVersion);

    public function getById($guid, string $aggregateClass);
}

