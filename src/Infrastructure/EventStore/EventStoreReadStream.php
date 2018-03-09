<?php 

namespace App\Infrastructure\EventStore;

use App\Domain\Travel\EventDescription;
use App\Domain\Travel\EventStore\EventStoreReadInterface;
use PicoFeed\Config\Config;
use PicoFeed\Parser\Feed;
use PicoFeed\PicoFeedException;
use PicoFeed\Reader\Reader;

final class EventStoreReadStream implements EventStoreReadInterface
{
    const STREAM_ACCEPT_HEADER = 'application/xml';
    const FEED_ACCEPT_HEADER = 'application/vnd.eventstore.atom+json';

    private $streamReader;
    private $readerConfig;
    private $dataTransformer;
    private $esLogin;
    private $esPassword;
    private $esUri;

    public function __construct(
        Reader $streamReader,
        Config $readerConfig,
        EventDescriptionDataTransformer $dataTransformer,
        string $esLogin,
        string $esPassword,
        string $esUri
    ) {
        $this->streamReader = $streamReader;
        $this->readerConfig = $readerConfig;
        $this->dataTransformer = $dataTransformer;
        $this->esLogin = $esLogin;
        $this->esPassword = $esPassword;
        $this->esUri = $esUri;
    }

    /**
     * @return array[EventDescription]
     */
    public function getEvents(string $streamId): array
    {
        try {
            $feed = $this->getFeed($streamId);
            $content = $this->getContent($feed);
            $events = [];
            foreach ($content as $event) {
                $events[] = $this->contentToEvent($event);
            }

            return $events;
        } catch(PicoFeedException $e) {
            throw new \InvalidArgumentException('error when retrieving stream');
        }
    }

    private function getFeed(string $streamId): Feed
    {
        $this->readerConfig->setAdditionalCurlOptions([ CURLOPT_HTTPHEADER => [ 'Accept: '.self::STREAM_ACCEPT_HEADER ] ]);
        $this->streamReader->setConfig($this->readerConfig);

        $resource = $this->streamReader->download($this->esUri.'/streams/'.$streamId, '', '', $this->esLogin, $this->esPassword);
        
        $parser = $this->streamReader->getParser(
            $resource->getUrl(),
            $resource->getContent(),
            $resource->getEncoding()
        );
        
        return $parser->execute();
    }

    private function getContent(Feed $feed): array
    {
        $this->readerConfig->setAdditionalCurlOptions([ CURLOPT_HTTPHEADER => [ 'Accept: '.self::FEED_ACCEPT_HEADER ] ]);
        $this->streamReader->setConfig($this->readerConfig);
        $content = [];

        foreach ($feed->getItems() as $item) {
            $resource = $this->streamReader->download($item->getUrl(), '', '', $this->esLogin, $this->esPassword);
            $content[] = json_decode($resource->getContent(), true);
        }

        return $content;
    }

    private function contentToEvent(array $content): EventDescription
    {
        $eventNumber = $content['content']['eventNumber'];
        $eventId = $content['content']['eventId'];
        $eventType = $content['content']['eventType'];
        $data = $content['content']['data'];

        return new EventDescription($eventId, $eventType, $data);
    }
}
