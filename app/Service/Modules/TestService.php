<?php

namespace App\Service\Modules;

use App\Service\Contracts\ITestService;

use App\Repository\Contracts\ITestRepository;
use App\Model\DB\User;

class TestService implements ITestService
{
    private $testRepository;

    public function __construct(ITestRepository $testRepository) {
        $this->testRepository = $testRepository;
    }

    public function GetUsers(){
        return $this->testRepository->FindAll();
    }

    public function GetUser($id){
        return $this->testRepository->FindByID($id);
    }

    public function GetUserByUsername($username){
        return $this->testRepository->FindByUsername($username);
    }

    public function CreateNewUser($data){
        $user = new User();
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->role_id = 1;
        return $this->testRepository->InsertUpdate($user);
    }

    public function UpdateUserProfile($data){
        $user = User::find($data['user_id']);

        if ($user == null){
            return null;
        }

        $user->password = $data['password'];
        return $this->testRepository->InsertUpdate($user);
    }

    public function DeleteUser($id){
        return $this->testRepository->Delete($id);
    }

    public function GetUsersWithDeleted(){
        return $this->testRepository->FindAllWithDeleted();
    }

    public function GetUserWithDeleted($id){
        return $this->testRepository->FindByIDWithDeleted($id);
    }

    public function RestoreUser($id){
        return $this->testRepository->RollbackDelete($id);
    }
}