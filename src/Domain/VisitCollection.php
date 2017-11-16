<?php

namespace App\Domain;

use App\Domain\Travel\ValueObject\Visit;

final class VisitCollection implements IteratorAggregate 
{
    private $visits;
        
    public function add(Visit $visit)
    {
        $this->events[] = $event;
    }

    public function clear()
    {
        $this->visits = [];
    }

    public function getIterator()
    {
        return new ArrayIterator($this->visits);
    }
}

