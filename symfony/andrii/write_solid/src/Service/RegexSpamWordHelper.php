<?php

namespace Write_solid\Service;

/**
 * Class RegexSpamWordHelper
 * @package Write_solid\Service
 */
class RegexSpamWordHelper
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

    public function getMatchSpamWords(string $content): array
    {
        $badWordsOnComment = [];
        $regex = implode('|', $this->spamWords());
        preg_match_all("/$regex/i", $content, $badWordsOnComment);

        return $badWordsOnComment[0];
    }
}