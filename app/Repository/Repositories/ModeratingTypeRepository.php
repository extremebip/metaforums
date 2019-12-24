<?php

namespace App\Repository\Repositories;

use App\Repository\Base\BaseRepository;
use App\Repository\Contracts\IModeratingTypeRepository;
use App\Model\DB\ModeratingType;

class ModeratingTypeRepository extends BaseRepository implements IModeratingTypeRepository
{
    public function __construct() {
        parent::__construct(new ModeratingType());
    }
}