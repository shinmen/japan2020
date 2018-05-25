<?php 

namespace App\Application;

use Symfony\Component\HttpFoundation\JsonResponse;

final class VisitListController
{
    private $dataDir;

    public function __construct(string $dataDir)
    {
        $this->dataDir = $dataDir;
    }

    public function __invoke()
    {
        $path = sprintf('%s/visits.json', $this->dataDir);
        $content = json_decode(file_get_contents($path), true);

        return new JsonResponse($content);
    }
}
