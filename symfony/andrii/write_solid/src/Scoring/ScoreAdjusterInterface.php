<?php


namespace Write_solid\Scoring;


use Write_solid\Entity\BigFootSighting;

interface ScoreAdjusterInterface
{
    public function adjustScore(int $finalScore, BigFootSighting $sighting): int;
}