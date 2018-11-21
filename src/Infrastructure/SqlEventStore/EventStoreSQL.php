<?php 

namespace App\Infrastructure\SqlEventStore;

use App\Domain\Travel\EventStore\EventStoreWriteInterface;
use GuzzleHttp\Psr7\Response;

final class EventStoreSQL implements EventStoreWriteInterface
{
    /**
     * @param EventDescription[]
     */
    public function writeBatchEvent(string $streamId, array $events): ResponseInterface
    {
        

        return new Response();
    }
}
