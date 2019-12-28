<?php

namespace App\Service\Modules;

use App\Service\Contracts\ITestService;

use App\Repository\Contracts\ITestRepository;
use App\Repository\Contracts\ICategoryRepository;
use App\Repository\Contracts\ISubCategoryRepository;
use App\Model\DB\User;
use App\Model\DB\Category;
use App\Model\DB\SubCategory;

class TestService implements ITestService
{
    private $testRepository;
    private $categoryRepository;
    private $subCategoryRepository;

    public function __construct(
        ITestRepository $testRepository, 
        ICategoryRepository $categoryRepository,
        ISubCategoryRepository $subCategoryRepository) 
    {
        $this->testRepository = $testRepository;
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
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

    public function GetCategories(){
        // $categories = $this->categoryRepository->FindAll();
        // return $this->categoryRepository->FindAll();
        return $this->categoryRepository->FindAll()->withoutTimestamp();
        // return $categories->map(function ($item){
        //     return [
        //         "id" => $item->id,
        //         "name" => $item->name
        //     ];
        // });
    }

    public function SaveCategory($data){
        $category = Category::find($data['id']);

        if (is_null($category)){
            $category = new Category();
        }
        
        $category->name = $data['name'];

        $new_category = $this->categoryRepository->InsertUpdate($category);
    }

    public function GetSubCategoriesByCategory($category_id){
        $sub_categories = $this->subCategoryRepository->FindAllSubCategoryByCategory($category_id);
        return $sub_categories->map(function ($item){
            return [
                "id" => $item->id,
                "name" => $item->name
            ];
        });
    }

    public function SaveSubCategory($data){
        $subcategory = SubCategory::find($data['id']);

        if (is_null($subcategory)){
            $subcategory = new SubCategory();
        }

        $subcategory->category_id = $data['category_id'];
        $subcategory->name = $data['name'];

        $new_subcategory = $this->subCategoryRepository->InsertUpdate($subcategory);
    }
}