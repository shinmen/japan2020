<?php

namespace App\Domain;

use App\Domain\Event;

final class EventCollection implements \IteratorAggregate 
{
    private $events;
        
    public function add(Event $event)
    {
        $this->events[] = $event;
    }

    public function clear()
    {
        $this->events = [];
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->events);
    }
}

