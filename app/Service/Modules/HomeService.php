<?php

namespace App\Service\Modules;

use App\Service\Contracts\IHomeService;
use App\Repository\Contracts\ICategoryRepository;
use App\Repository\Contracts\ISubCategoryRepository;
use App\Repository\Contracts\IThreadRepository;
use App\Repository\Contracts\IPostReplyRepository;

class HomeService implements IHomeService
{
    private $categoryRepository;
    private $subCategoryRepository;
    private $threadRepository;
    private $postReplyRepository;

    public function __construct(
        ICategoryRepository $categoryRepository, 
        ISubCategoryRepository $subCategoryRepository,
        IThreadRepository $threadRepository,
        IPostReplyRepository $postReplyRepository) {
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
        $this->threadRepository = $threadRepository;
        $this->postReplyRepository = $postReplyRepository;
    }

    public function GetCategories()
    {
        return $this->categoryRepository->FindAll()->withoutTimestamp();
    }

    public function GetSubCategories()
    {
        return $this->subCategoryRepository->FindAll()->withoutTimestamp();
    }

    public function GetThreadsBySubCategory($subCategoryId)
    {
        $DBthreads = $this->threadRepository->FindAllBySubCategory($subCategoryId);
        if (is_null($DBthreads))
            return null;
        
    }
}
