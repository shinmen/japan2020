<?php 

namespace App\Application;

use App\Infrastructure\EventStore\EventStoreReadStream;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class HistoryEventController
{
    public function __construct(EventStoreReadStream $readerStream)
    {
        $this->readerStream = $readerStream;
    }

    public function __invoke(string $streamId, Request $request)
    {
        $events = $this->readerStream->getEvents($streamId);

        return new JsonResponse($events);
    }
}
