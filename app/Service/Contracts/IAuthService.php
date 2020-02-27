<?php

namespace App\Service\Contracts;

interface IAuthService
{
    public function GetUserByEmailOrUsername($field);
    public function RegisterUser($data);
    public function GetUserByID($id);
    public function CreateUserLogin($user_id, $time_login);
    public function SetLogoutTime($user_id, $time_logout);
}