<?php

namespace App\Infrastructure\Entity;

use App\Domain\Travel\Model\EventDescription;
use App\Domain\Travel\VO\EventMetadata;

class Event
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $eventId;

    /**
     * @var string
     */
    private $streamId;

    /**
     * @var string
     */
    private $eventType;

    /**
     * @var array
     */
    private $data;

    public function __construct(EventDescription $event, EventMetadata $metadata)
    {
        $this->eventId = $event->getEventId();
        $this->eventType = $event->getEventType();
        $this->data = $event->getData();
        $this->streamId = $metadata->getStreamId();
    }

    public function getEventId(): string
    {
        return $this->eventId;
    }

    public function getEventType(): string
    {
        return $this->eventType;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function toModel()
    {
        return new EventDescription($this->eventId, $this->eventType, $this->data);
    }
}
