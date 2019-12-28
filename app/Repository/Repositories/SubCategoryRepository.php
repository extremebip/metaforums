<?php

namespace App\Repository\Repositories;

use App\Repository\Base\BaseRepository;
use App\Repository\Contracts\ISubCategoryRepository;
use App\Model\DB\SubCategory;

class SubCategoryRepository extends BaseRepository implements ISubCategoryRepository
{
    public function __construct() {
        parent::__construct(new SubCategory());
    }

    public function FindAllSubCategoryByCategory($category_id){
        return SubCategory::where('category_id', $category_id)->get();
    }
}