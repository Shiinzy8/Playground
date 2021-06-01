<?php

namespace Write_solid\Service;

use Write_solid\Entity\BigFootSighting;
use Write_solid\Model\BigFootSightingScore;
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
    private array $scoringFactors;

    /**
     * SightingScorer constructor.
     * @param array $scoringFactors
     */
    public function __construct(array $scoringFactors)
    {
        $this->scoringFactors = $scoringFactors;
    }

    public function score(BigFootSighting $sighting): BigFootSightingScore
    {
        $score = 0;
        foreach ($this->scoringFactors as $scoringFactor) {
            $score += $scoringFactor->score($sighting);
        }

        return new BigFootSightingScore($score);
    }
}
