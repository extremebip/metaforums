<?php

namespace App\Repository\Repositories;

use App\Repository\Base\BaseRepository;
use App\Repository\Contracts\IModeratingRepository;
use App\Model\DB\Moderating;

class ModeratingRepository extends BaseRepository implements IModeratingRepository
{
    public function __construct() {
        parent::__construct(new Moderating());
    }
}