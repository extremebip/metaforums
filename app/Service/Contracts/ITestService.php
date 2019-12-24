<?php

namespace App\Service\Contracts;

use App\Model\DB\User;

interface ITestService
{
    public function GetUsers();
    public function GetUser($id);
    public function GetUserByUsername($username);
    public function CreateNewUser($data);
    public function UpdateUserProfile($data);
    public function DeleteUser($id);

    public function GetUsersWithDeleted();
    public function GetUserWithDeleted($id);
    public function RestoreUser($id);
}