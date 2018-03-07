<?php

namespace App\Domain\Travel;

use App\Domain\AggregateRoot;

interface RepositoryInterface
{
    public function save(AggregateRoot $aggregate, int $expectedVersion);

    public function getById($guid, string $aggregateClass);
}
