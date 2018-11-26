<?php 

namespace App\Infrastructure\SqlEventStore;

use App\Domain\Travel\EventStore\EventStoreReadInterface;
use App\Domain\Travel\EventStore\EventStoreWriteInterface;
use App\Domain\Travel\VO\EventMetadata;
use App\Infrastructure\Entity\Event;
use App\Infrastructure\Repository\EventRepository;
use Doctrine\Common\Persistence\ObjectManager;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

final class EventStoreSQL implements EventStoreWriteInterface, EventStoreReadInterface
{
    private $repo;
    private $om;

    public function __construct(EventRepository $repo, ObjectManager $om)
    {
        $this->repo = $repo;
        $this->om = $om;
    }

    /**
     * @see EventStoreWriteInterface
     */
    public function writeBatchEvent(string $streamId, array $events): ResponseInterface
    {
        $om = $this->om;
        $events = array_map(function(EventDescription $event) use($streamId) {
            return new Event(new EventMetadata($streamId), $event);
        }, $events);

        array_walk($events, function($eventDescription, $key, $om) {
            $event = new Event(new EventMetadata($streamId), $event);
            $this->om->persist($event);
        });

        $om->flush();

        return new Response();
    }

    /**
     * @see EventStoreReadInterface
     */
    public function getEvents(string $streamId): array
    {
        return $this->repo->findByStream($streamId);
    }
}
