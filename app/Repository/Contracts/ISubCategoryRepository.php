<?php

namespace App\Repository\Contracts;

interface ISubCategoryRepository
{
    public function FindAllSubCategoryByCategory($category_id);
}