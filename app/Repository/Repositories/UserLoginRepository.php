<?php

namespace App\Repository\Repositories;

use App\Repository\Base\BaseRepository;
use App\Repository\Contracts\IUserLoginRepository;
use App\Model\DB\UserLogin;

class UserLoginRepository extends BaseRepository implements IUserLoginRepository
{
    public function __construct() {
        parent::__construct(new UserLogin());
    }
}