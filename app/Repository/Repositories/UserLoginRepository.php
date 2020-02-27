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

    public function FindByUserIDAndTimeLogin($user_id, $time_login){
        return UserLogin::where([
            ['user_id', '=', $user_id],
            ['time_login', '=', $time_login]
        ])->first();
    }

    public function FindByUserIDOrderByLatestTimeLogin($user_id){
        return UserLogin::where('user_id', '=', $user_id)
            ->latest('time_login')
            ->first();
    }
}