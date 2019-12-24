<?php

namespace App\Repository\Repositories;

use App\Repository\Base\BaseRepository;
use App\Repository\Contracts\ITestRepository;
use App\Model\DB\User;

class TestRepository extends BaseRepository implements ITestRepository
{
    public function __construct() {
        parent::__construct(new User());
    }

    public function FindByUsername($username)
    {
        $user = User::where('username', '=', $username)->first();
        return $user;
    }
}
