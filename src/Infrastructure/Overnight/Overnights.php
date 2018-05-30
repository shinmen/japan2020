<?php 

namespace App\Infrastructure\Overnight;

use GuzzleHttp\ClientInterface;
use \DateTimeInterface;

final class Overnights
{
    private $client;
    private $apiKey;

    public function __construct(ClientInterface $client, string $overnightApiKey)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    public function getOvernights(
      DateTimeInterface $checkinDate,
      DateTimeInterface $checkoutDate,
      int $guests,
      string $city
    ) {
        $response = $client->request('GET', '/api/v2/explore_tabs', [
                'query' => [
                   'version' => '1.2.8',
                   '_format' => 'for_explore_search_web',
                   'items_per_grid' => 10,
                   'timezone_offset' => 120,
                   'refinements[]' => 'homes',
                   'allow_override[]' => '',
                   'checkin' => $checkinDate->format('Y-M-d'),
                   'checkout' => $checkoutDate->format('Y-M-d'),
                   'children' => 0,
                   'infants' => 0,
                   'adults' => $guests,
                   'guests' => $guests,
                   'location' => sprintf('%s,Japan', $city),
                   '_intents' => 'p1',
                   'key' => $this->overnightApiKey,
                   'currency' => 'EUR',
                   'locale' => 'fr',
                ],
            ]
        );

        $content = json_decode((string) $response->getBody(), true);
        $mapper = new OvernightRequestToOvernightMapper();

        return $mapper->buildOvernights($guests, $content);
    }
}
