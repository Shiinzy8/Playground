<?php

namespace Write_solid\Service;

use Write_solid\Entity\BigFootSighting;
use Write_solid\Model\BigFootSightingScore;
use Write_solid\Scoring\PhotoFactor;
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
     * SightingScorer constructor.
     * @param array $scoringFactors
     */
    public function __construct(iterable $scoringFactors)
    {
        $this->scoringFactors = $scoringFactors;
    }

    public function score(BigFootSighting $sighting): BigFootSightingScore
    {
        $score = 0;
        foreach ($this->scoringFactors as $scoringFactor) {
            // LSP violation and also OCP violation
            if ($scoringFactor instanceof PhotoFactor && count($sighting->getImages()) === 0) {
                continue;
            }

            $score += $scoringFactor->score($sighting);
        }

        return new BigFootSightingScore($score);
    }
}
