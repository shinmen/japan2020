<?php 

namespace App\Infrastructure\EventStore;

use App\Domain\Travel\EventDescription;

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
