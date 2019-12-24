<?php

namespace App\Repository\Repositories;

use App\Repository\Base\BaseRepository;
use App\Repository\Contracts\IRoleRepository;
use App\Model\DB\Role;

class RoleRepository extends BaseRepository implements IRoleRepository
{
    public function __construct() {
        parent::__construct(new Role());
    }
}
