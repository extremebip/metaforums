<?php

namespace App\Service\Contracts;

interface IAuthService
{
    public function GetUserByEmailOrUsername($field);
    public function RegisterUser($data);
    public function GetUserByID($id);
}