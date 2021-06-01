<?php


namespace Write_solid\Scoring;


use Write_solid\Entity\BigFootSighting;

interface ScoringFactorInterface
{
    public function score(BigFootSighting $sighting): int;
}