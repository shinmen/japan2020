<?php 

namespace App\Infrastructure\Repository;

use App\Infrastructure\Entity\Event;
use Doctrine\Common\Persistence\ObjectManager;

final class EventRepository
{
    private $repo;

    public function __construct(ObjectManager $em)
    {
        $this->repo = $em->getRepository(Event::class);
    }

    /**
     * @return Event[]
     */
    public function findByStream(string $streamId): array
    {
        return $this->repo->findBy(['streamId' => $streamId]);
    }
}
