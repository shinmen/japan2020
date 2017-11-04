<?php 

namespace App\Domain\Travel\Entity;

use App\Domain\AggregateRoot;

class Holiday extends AggregateRoot
{
    private $startedAt;

    private $endedAt;

    private $daySchedules;

    private $railPassPackage;


    protected function loadOne(EventOne $event)
    {
           
    }

    protected function loadTwo(EventTwo $event)
    {

    }


}

