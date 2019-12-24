<?php

namespace App\Repository\Repositories;

use App\Repository\Base\BaseRepository;
use App\Repository\Contracts\IPostFavoriteRepository;
use App\Model\DB\PostFavorite;

class PostFavoriteRepository extends BaseRepository implements IPostFavoriteRepository
{
    public function __construct() {
        parent::__construct(new PostFavorite());
    }
}