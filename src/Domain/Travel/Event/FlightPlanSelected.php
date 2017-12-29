<?php

namespace Domain\Travel\Event;

use App\Domain\Event;

final class FlightPlanSelected implements Event
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}
