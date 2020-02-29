<?php

namespace App\Repository\Repositories;

use App\Repository\Base\BaseRepository;
use App\Repository\Contracts\IPostReplyRepository;
use App\Model\DB\PostReply;

class PostReplyRepository extends BaseRepository implements IPostReplyRepository
{
    public function __construct() {
        parent::__construct(new PostReply());
    }

    public function FindAllByThreadOrderByLatestCreatedAt($threadId)
    {
        return PostReply::where('thread_id', '=', $threadId)->latest()->get();
    }
}