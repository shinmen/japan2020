<?php 

namespace App\Domain\Travel\Entity;

use App\Domain\AggregateRoot;

final class Holiday extends AggregateRoot
{
    private $startedAt;

    private $endedAt;

    private $daySchedules;

    private $railPassPackage;


    private function __construct(){}


    protected function loadOne(EventOne $event)
    {
           
    }

    protected function loadTwo(EventTwo $event)
    {

    }


}

