<?php

namespace App\Repository\Repositories;

use App\Repository\Base\BaseRepository;
use App\Repository\Contracts\IModeratorRepository;
use App\Model\DB\Moderator;

class ModeratorRepository extends BaseRepository implements IModeratorRepository
{
    public function __construct() {
        parent::__construct(new Moderator());
    }
}