<?php

namespace App\Domain\Travel;

class EventDescription implements \JsonSerializable
{
    /**
     * @var string
     */
    private $eventId;

    /**
     * @var string
     */
    private $eventType;

    /**
     * @var array
     */
    private $data;

    public function __construct(string $eventId, string $eventType, array $data)
    {
        $this->eventId = $eventId;
        $this->eventType = $eventType;
        $this->data = $data;
    }

    public function getEventId(): string
    {
        return $this->eventId;
    }

    public function getEventType(): string
    {
        return $this->eventType;
    }

    public function getData(): string
    {
        return $this->data;
    }

    public function jsonSerialize()
    {
        return [
            'eventId' => $this->eventId,
            'eventType' => $eventType,
            'data' => $this->data,
        ];
    }
}
