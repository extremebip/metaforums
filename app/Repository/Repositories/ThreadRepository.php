<?php

namespace App\Repository\Repositories;

use App\Repository\Base\BaseRepository;
use App\Repository\Contracts\IThreadRepository;
use App\Model\DB\Thread;

class ThreadRepository extends BaseRepository implements IThreadRepository
{
    public function __construct() {
        parent::__construct(new Thread());
    }
}