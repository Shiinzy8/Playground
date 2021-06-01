<?php

namespace Write_solid\Service;

use Write_solid\Entity\BigFootSighting;
use Write_solid\Model\BigFootSightingScore;
use Write_solid\Scoring\ScoreAdjusterInterface;
use Write_solid\Scoring\ScoringFactorInterface;

/**
 * Class SightingScorer
 * @package Write_solid\Service
 */
class SightingScorer
{
    /**
     * @var ScoringFactorInterface[]
     */
    private iterable $scoringFactors;

    /**
     * @var ScoreAdjusterInterface[]
     */
    private iterable $scoringAdjusters;

    /**
     * SightingScorer constructor.
     * @param array $scoringFactors
     */
    public function __construct(iterable $scoringFactors, iterable $scoringAdjusters)
    {
        $this->scoringFactors = $scoringFactors;
        $this->scoringAdjusters = $scoringAdjusters;
    }

    public function score(BigFootSighting $sighting): BigFootSightingScore
    {
        $score = 0;
        foreach ($this->scoringFactors as $scoringFactor) {
            $score += $scoringFactor->score($sighting);
        }

        foreach ($this->scoringAdjusters as $scoringAdjuster) {
            $score = $scoringAdjuster->adjustScore($score, $sighting);
        }

        return new BigFootSightingScore($score);
    }
}
