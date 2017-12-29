<?php

namespace App\Domain\Travel\Entity;

final class Day
{
    private $overnight;

    private $visits;

    private function __construct()
    {
        $this->visits = new VisitCollection();
    }

    public function bookAccomodation(Overnight $overnight) :void
    {
        $this->overnight = $overnight;
    }

    public function scheduleVisit(Visit $visit) :void
    {
        $this->visits->add($visit);
    }

    public function getOverNight()
    {
        return $this->overnight;
    }

    public function getVisits()
    {
        return $this->visits;
    }
}

