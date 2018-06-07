<?php 

namespace App\Application;

use App\Infrastructure\EventStore\EventDescriptionDataTransformer;
use App\Infrastructure\EventStore\EventStoreWriteStream;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class NewBatchEventController
{
    private $writer;

    private $transformer;

    public function __construct(EventStoreWriteStream $writer, EventDescriptionDataTransformer $transformer)
    {
        $this->writer = $writer;
        $this->transformer = $transformer;
    }

    public function __invoke(string $streamId, Request $request)
    {
        $events = [];
        $content = json_decode($request->getContent(), true);
        foreach ($content as $event) {
            $events[] = $this->transformer->arrayToEventDescription($event);
        }
        $response = $this->writer->writeBatchEvent($streamId, $events);

        return new JsonResponse(['success' => true], $response->getStatusCode());
    }
}
