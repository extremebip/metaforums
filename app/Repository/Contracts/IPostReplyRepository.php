<?php

namespace App\Repository\Contracts;

interface IPostReplyRepository
{
    public function FindAllByThreadOrderByCreatedAt($threadId);
}