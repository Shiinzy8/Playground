<?php

namespace Write_solid\Service;

use Write_solid\Comment\CommentSpamCounterInterface;

/**
 * Class RegexSpamWordHelper
 * @package Write_solid\Service
 */
class RegexSpamWordHelper implements CommentSpamCounterInterface
{
    /**
     * @return string[]
     */
    private function spamWords(): array
    {
        return [
            'follow me',
            'twitter',
            'facebook',
            'earn money',
            'SymfonyCats',
        ];
    }

    public function countSpamWords(string $content): int
    {
        return count($this->getMatchSpamWords($content));
    }

    private function getMatchSpamWords(string $content): array
    {
        $badWordsOnComment = [];
        $regex = implode('|', $this->spamWords());
        preg_match_all("/$regex/i", $content, $badWordsOnComment);

        return $badWordsOnComment[0];
    }
}