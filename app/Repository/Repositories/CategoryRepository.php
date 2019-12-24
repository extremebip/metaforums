<?php

namespace App\Repository\Repositories;

use App\Repository\Base\BaseRepository;
use App\Repository\Contracts\ICategoryRepository;
use App\Model\DB\Category;

class CategoryRepository extends BaseRepository implements ICategoryRepository
{
    public function __construct() {
        parent::__construct(new Category());
    }
}