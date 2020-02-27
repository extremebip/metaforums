<?php

namespace App\Repository\Contracts;

interface IUserLoginRepository
{
    public function FindByUserIDAndTimeLogin($user_id, $time_login);
    public function FindByUserIDOrderByLatestTimeLogin($user_id);
}