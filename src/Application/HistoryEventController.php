<?php 

namespace App\Application;

use App\Domain\Travel\EventStore\EventStoreReadInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class HistoryEventController
{
    public function __construct(EventStoreReadInterface $readerStream)
    {
        $this->readerStream = $readerStream;
    }

    public function __invoke(string $streamId, Request $request)
    {
        $events = $this->readerStream->getEvents($streamId);

        return new JsonResponse($events);
    }
}
