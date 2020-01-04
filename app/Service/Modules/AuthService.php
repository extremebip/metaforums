<?php

namespace App\Service\Modules;

use App\Service\Contracts\IAuthService;
use App\Repository\Contracts\IUserRepository;
use App\Model\DB\User;

class AuthService implements IAuthService
{
    private $userRepository;

    public function __construct(IUserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function GetUserByEmailOrUsername($field){
        $user = $this->userRepository->FindByUsername($field);
        if (!is_null($user))
            return $user;

        $user = $this->userRepository->FindByEmail($field);
        if (!is_null($user))
            return $user;

        return null;
    }
}
