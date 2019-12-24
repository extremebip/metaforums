<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\Contracts\ITestService;
use App\Model\DB\User;

class TestController extends Controller
{
    private $testService;

    public function __construct(ITestService $testService) {
        $this->testService = $testService;
    }

    public function index()
    {
        // Test get all
        // return $this->testService->GetUsers();

        // Test Get by ID
        // return $this->testService->GetUser(2);

        // Test Get By Username
        // return $this->testService->GetUserByUsername("ExtremeBip");

        // Test Insert
        // $data = array();
        // $data['username'] = 'Testing2';
        // $data['email'] = 'test.user2@gmail.com';
        // $data['password'] = bcrypt('12345678');
        // return $this->testService->CreateNewUser($data);

        // Test Update
        // $data = array();
        // $data['user_id'] = 2;
        // $data['password'] = bcrypt('12345678');
        // return $this->testService->UpdateUserProfile($data);

        // Test Delete
        // $data = array();
        // $data['username'] = 'Mordred';
        // $user = $this->testService->GetUserByUsername($data['username']);
        // return $this->testService->DeleteUser($user->id);

        // Test Get deleted
        // return $this->testService->GetUsersWithDeleted();
        // return $this->testService->GetUserWithDeleted(5);

        // Test Restore
        // $deleted_user = $this->testService->GetUserWithDeleted(4);
        // $user = $this->testService->RestoreUser($deleted_user->id);
        // var_dump($user);
    }
}