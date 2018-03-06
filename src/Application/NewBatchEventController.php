<?php 

namespace App\Application;

use App\Infrastructure\EventStore\EventStoreWriteStream;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class NewBatchEventController
{
    private $writer;

    public function __construct(EventStoreWriteStream $writer)
    {
        $this->writer = $writer;
    }

    public function __invoke(string $streamId, Request $request)
    {
        $response = $this->writer->writeBatchEvent(json_decode($request->getContent(), true));

        return new Response('', $response->getStatusCode());
    }
}
