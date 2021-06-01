<?php


namespace Write_solid\Service;


use Write_solid\Entity\BigFootSighting;
use Write_solid\Model\DebuggableBigFootSightingScore;

class DebuggableSightingScore extends SightingScorer
{
    public function score(BigFootSighting $sighting): DebuggableBigFootSightingScore
    {
        $bfsScore = parent::score($sighting);

        return new DebuggableBigFootSightingScore($bfsScore->getScore(), 100);
    }
}