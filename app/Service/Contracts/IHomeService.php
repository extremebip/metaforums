<?php

namespace App\Service\Contracts;

interface IHomeService
{
    public function GetCategories();
    public function GetSubcategories();
    public function GetSubcategoryByID($subCategoryId);
    public function GetThreadsBySubCategory($subCategoryId);
    public function GetUserForPostComponent($userId);
    public function SaveThread($data);
}