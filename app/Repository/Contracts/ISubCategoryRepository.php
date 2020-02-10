<?php

namespace App\Repository\Contracts;

interface ISubCategoryRepository
{
    public function FindAllByCategory($category_id);
}