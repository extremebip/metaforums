<?php

namespace App\Service\Modules;

use App\Service\Contracts\IAuthService;
use App\Repository\Contracts\IUserRepository;
use App\Repository\Contracts\IUserLoginRepository;
use App\Model\DB\User;
use App\Model\DB\UserLogin;
use Illuminate\Support\Facades\Hash;

class AuthService implements IAuthService
{
    private $userRepository;
    private $userLoginRepository;

    public function __construct(
        IUserRepository $userRepository, 
        IUserLoginRepository $userLoginRepository
    ) {
        $this->userRepository = $userRepository;
        $this->userLoginRepository = $userLoginRepository;
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

    public function RegisterUser($data){
        $user = new User();

        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->role_id = 1;
        
        return $this->userRepository->InsertUpdate($user);
    }

    public function GetUserByID($id)
    {
        return $this->userRepository->Find($id);
    }

    public function CreateUserLogin($user_id, $time_login){
        $userLogin = new UserLogin();

        $userLogin->user_id = $user_id;
        $userLogin->time_login = $time_login;

        return $this->userLoginRepository->InsertUpdate($userLogin);
    }

    public function SetLogoutTime($user_id, $time_logout){
        $userLogin = $this->userLoginRepository->FindByUserIDOrderByLatestTimeLogin($user_id);
        $userLogin->time_logout = $time_logout;
        return $this->userLoginRepository->InsertUpdate($userLogin);
    }
    
}
