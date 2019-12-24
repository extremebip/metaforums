<?php

namespace App\Repository\Repositories;

use App\Repository\Base\BaseRepository;
use App\Repository\Contracts\IPostRepository;
use App\Model\DB\Post;

class PostRepository extends BaseRepository implements IPostRepository
{
    public function __construct() {
        parent::__construct(new Post());
    }
}