<?php

namespace Write_solid\Comment;

use Write_solid\Entity\Comment;
use Write_solid\Service\RegexSpamWordHelper;

/**
 * Class CommentSpamManager
 * @package Write_solid\Comment
 */
class CommentSpamManager
{
    private RegexSpamWordHelper $spamWordHelper;

    public function __construct(RegexSpamWordHelper $spamWordHelper)
    {
        $this->spamWordHelper = $spamWordHelper;
    }

    public function validate(Comment $comment): void
    {
        $content = $comment->getContent();
        $badWordsOnComment = $this->spamWordHelper->getMatchSpamWords($content);

        if (count($badWordsOnComment) >= 2) {
            // We could throw a custom exception if needed
            throw new \RuntimeException('Message detected as spam');
        }
    }
}