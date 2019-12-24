<?php

namespace App\Repository\Repositories;

use App\Repository\Base\BaseRepository;
use App\Repository\Contracts\IUserRepository;
use App\Model\DB\User;

class UserRepository extends BaseRepository implements IUserRepository
{
    public function __construct() {
        parent::__construct(new User());
    }
}
