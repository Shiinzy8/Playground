<?php

namespace Write_solid\Scoring;

use Write_solid\Entity\BigFootSighting;

class PhotoFactor implements ScoringFactorInterface, ScoreAdjusterInterface
{
    public function score(BigFootSighting $sighting): int
    {
        if (count($sighting->getImages()) === 0) {
            return 0;
        }

        $score = 0;
        foreach ($sighting->getImages() as $image) {
            $score += rand(1, 100); // TODO analyze image
        }

        return $score;
    }

    public function adjustScore(int $finalScore, BigFootSighting $sighting): int
    {
        $photosCount = count($sighting->getImages());
        if ($photosCount < 50 && $photosCount > 2) {
            $finalScore += $photosCount * 5;
        }

        return $finalScore;
    }
}