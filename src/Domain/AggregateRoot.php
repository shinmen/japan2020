<?php

namespace App\Domain;

use App\Domain\Event;
use App\Domain\EventCollection;

abstract class AggregateRoot 
{
    protected $guid;

    protected $version;

    protected $changes;

    public function getUnCommitedChanges()
    {
        return $this->changes;
    }

    public function markChangesAsCommited()
    {
        $this->changes = new \ArrayObject();
    }

    public function replayHistory(EventCollection $history)
    {
        foreach ($history as $event) {
            $this->applyChange($event, false);       
        }
    }

    protected function applyEvent(Event $event)
    {
        $this->applyChange($event, true);   
    }

    private function applyChange(Event $event, bool $isNew)
    {
        $this->apply($event);
        if ($isNew) {
            $this->changes->append($event);
        }
    }
    
    public function __call($method, $args)
    {
        $event = $args[0];
        if (!$event instanceOf Event) {
            throw new Exception();
        }
        $refClassEvent = new ReflectionClass($args[0]);

        $methodToCall = $method.$refClassEvent->getShortName();
        if (!method_exists($this, $methodToCall)) {
            throw new Exception();
        }

        $this->$method($args[0]);
    }
}

