<?php 

namespace App\Infrastructure\SqlEventStore;

use App\Domain\Travel\EventStore\EventStoreReadInterface;
use App\Domain\Travel\EventStore\EventStoreWriteInterface;
use App\Domain\Travel\Model\EventDescription;
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

    public function __construct(
        EventRepository $repo,
        ObjectManager $om    
    ) {
        $this->repo = $repo;
        $this->om = $om;
    }

    /**
     * @see EventStoreWriteInterface
     */
    public function writeBatchEvent(string $streamId, array $events): ResponseInterface
    {
        $om = $this->om;

        array_walk($events, function($eventDescription, $key, $om) use($streamId) {
            $event = new Event($eventDescription, new EventMetadata($streamId));
            $this->om->persist($event);
        }, $om);

        $om->flush();

        return new Response();
    }

    /**
     * @see EventStoreReadInterface
     */
    public function getEvents(string $streamId): array
    {
        $events = $this->repo->findByStream($streamId);

        return array_map(function($event) {
            return $event->toModel();
        }, $events);
    }
}
