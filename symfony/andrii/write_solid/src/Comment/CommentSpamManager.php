<?php

namespace Write_solid\Comment;

use Write_solid\Entity\Comment;

/**
 * Class CommentSpamManager
 * @package Write_solid\Comment
 */
class CommentSpamManager
{
    private CommentSpamCounterInterface $spamWordCounter;

    public function __construct(CommentSpamCounterInterface $spamWordCounter)
    {
        $this->spamWordCounter = $spamWordCounter;
    }

    public function validate(Comment $comment): void
    {
        $content = $comment->getContent();
        $badWordsOnComment = $this->spamWordCounter->countSpamWords($content);

        if ($badWordsOnComment >= 2) {
            // We could throw a custom exception if needed
            throw new \RuntimeException('Message detected as spam');
        }
    }
}