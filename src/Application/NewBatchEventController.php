<?php 

namespace App\Application;

use App\Infrastructure\EventStore\EventStoreWriteStream;
use Symfony\Component\HttpFoundation\Request;

final class NewBatchEventController
{
    private $writer;

    public function __construct(EventStoreWriteStream $writer)
    {
        $this->writer = $writer;
    }

    public function __invoke(Request $request)
    {
        $response = $this->writer->writeBatchEvent(json_decode($request->request->all(), true));

        return new Response('', $response->getStatusCode());
    }
}