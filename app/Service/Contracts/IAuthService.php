<?php

namespace App\Service\Contracts;

interface IAuthService
{
    public function GetUserByEmailOrUsername($field);
}