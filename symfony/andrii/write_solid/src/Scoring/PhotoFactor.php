<?php

namespace Write_solid\Scoring;

use Write_solid\Entity\BigFootSighting;

class PhotoFactor implements ScoringFactorInterface
{
    public function score(BigFootSighting $sighting): int
    {
        if (count($sighting->getImages()) === 0) {
            throw new \InvalidArgumentException('Invalid BigFootSighting, it should have at least one photo');
        }

        $score = 0;
        foreach ($sighting->getImages() as $image) {
            $score += rand(1, 100); // TODO analyze image
        }

        return $score;
    }
}