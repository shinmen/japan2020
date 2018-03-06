<?php 

namespace App\Infrastructure\EventStore;

use PicoFeed\Config\Config;
use PicoFeed\Parser\Feed;
use PicoFeed\PicoFeedException;
use PicoFeed\Reader\Reader;

final class EventStoreReadStream
{
    const STREAM_ACCEPT_HEADER = 'application/xml';
    const FEED_ACCEPT_HEADER = 'application/vnd.eventstore.atom+json';

    private $streamReader;
    private $readerConfig;
    private $esLogin;
    private $esPassword;
    private $esUri;

    public function __construct(
        Reader $streamReader,
        Config $readerConfig,
        string $esLogin,
        string $esPassword,
        string $esUri
    ) {
        $this->streamReader = $streamReader;
        $this->readerConfig = $readerConfig;
        $this->esLogin = $esLogin;
        $this->esPassword = $esPassword;
        $this->esUri = $esUri;
    }

    public function getEvents(string $streamId)
    {
        try {
            $feed = $this->getFeed($streamId);
            return $this->getContent($feed);
        } catch(PicoFeedException $e) {
            throw new \InvalidArgumentException();
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
}
