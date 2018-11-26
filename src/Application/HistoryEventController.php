<?php 

namespace App\Application;

use App\Domain\Travel\EventStore\EventStoreReadInterface;
use App\Infrastructure\Adapter\EventDescriptionDataTransformer;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class HistoryEventController
{
    private $readerStream;
    private $transformer;

    public function __construct(
        EventStoreReadInterface $readerStream,
        EventDescriptionDataTransformer $transformer
    ) {
        $this->readerStream = $readerStream;
        $this->transformer = $transformer;
    }

    public function __invoke(string $streamId, Request $request)
    {
        $events = $this->readerStream->getEvents($streamId);
        $transformer = $this->transformer;

        $eventsAsArray = array_map(function($event) use($transformer){
            return $transformer->eventDescriptionToArray($event);
        }, $events);

        return new JsonResponse($eventsAsArray);
    }
}
