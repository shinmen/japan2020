<?php

namespace App\Infrastructure\Adapter;

use App\Domain\Travel\Model\EventDescription;

final class EventDescriptionDataTransformer
{
    public function arrayToEventDescription(array $event): EventDescription
    {
        //$eventNumber = $event['eventI']['eventNumber'];
        $eventId = $event['eventId'];
        $eventType = $event['eventType'];
        $data = $event['data'];

        return new EventDescription($eventId, $eventType, $data);
    }

    public function eventDescriptionToArray(EventDescription $event): array
    {
        return [
            'eventId' => $event->getEventId(),
            'eventType' => $event->getEventType(),
            'data' => $event->getData(),
        ];
    }
}
