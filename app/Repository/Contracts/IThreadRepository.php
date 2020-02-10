<?php

namespace App\Repository\Contracts;

interface IThreadRepository
{
    public function FindAllBySubCategory($subCategoryId);
}