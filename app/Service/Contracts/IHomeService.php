<?php

namespace App\Service\Contracts;

interface IHomeService
{
    public function GetCategories();
    public function GetSubcategories();
    public function GetThreadsBySubCategory($subCategoryId);
}