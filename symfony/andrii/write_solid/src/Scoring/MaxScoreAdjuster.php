<?php

namespace Write_solid\Scoring;

use Write_solid\Entity\BigFootSighting;

/**
 * Class MaxScoreAdjuster
 * @package Write_solid\Scoring
 */
class MaxScoreAdjuster implements ScoreAdjusterInterface
{
    /**
     * @inheritDoc
     */
    public function adjustScore(int $finalScore, BigFootSighting $sighting): int
    {
        return max($finalScore, 100);
    }
}