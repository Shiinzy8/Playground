<?php

namespace Write_solid\Comment;

interface CommentSpamCounterInterface
{
    public function countSpamWords(string $content): int;
}