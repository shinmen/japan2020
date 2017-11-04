<?php

namespace App\Domain;

use App\Domain\AggregateRoot;

interface RepositoryInterface
{
    public function save(AggregateRoot $aggregate, int $expectedVersion);

    public function getById($guid, string $aggregateClass);
}

