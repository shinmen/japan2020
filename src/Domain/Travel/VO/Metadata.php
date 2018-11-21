<?php 

namespace App\Domain\Travel\VO;

final class EventMetadata
{
    /**
     * @var string
     */
    private $streamId;

    public function __construct(string $streamId)
    {
        $this->streamId = $streamId;
    }

    public function getStreamId(): string
    {
        return $this->streamId;
    }
}
