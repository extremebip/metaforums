<?php

namespace App\Repository\Contracts;

interface IPostReplyRepository
{
    public function FindAllByThreadOrderByLatestCreatedAt($threadId);
}