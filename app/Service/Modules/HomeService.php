<?php

namespace App\Service\Modules;

use Carbon\Carbon;
use App\Service\Contracts\IHomeService;
use App\Repository\Contracts\ICategoryRepository;
use App\Repository\Contracts\ISubCategoryRepository;
use App\Repository\Contracts\IThreadRepository;
use App\Repository\Contracts\IPostReplyRepository;
use App\Repository\Contracts\IUserRepository;

class HomeService implements IHomeService
{
    private $categoryRepository;
    private $subCategoryRepository;
    private $threadRepository;
    private $postReplyRepository;
    private $userRepository;

    public function __construct(
        ICategoryRepository $categoryRepository, 
        ISubCategoryRepository $subCategoryRepository,
        IThreadRepository $threadRepository,
        IPostReplyRepository $postReplyRepository,
        IUserRepository $userRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
        $this->threadRepository = $threadRepository;
        $this->postReplyRepository = $postReplyRepository;
        $this->userRepository = $userRepository;
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
        return $DBthreads->map(function ($item, $key)
        {
            $user = $this->userRepository->Find($item->user_id);
            $comments = $this->postReplyRepository->FindAllByThreadOrderByCreatedAt($item->id);
            return [
                'hot' => false,
                'title' => $item->title,
                'author' => $user->username,
                'views' => $item->view_count,
                'comments' => $comments->count(),
                'lastReply' => $this->getLastReply($comments->first())
            ];
        });
    }
    
    private function getLastReply($latestReply)
    {
        $time = $latestReply->created_at->copy();
        if ($time->tzName != '+07:00')
            $time->tz = '+07:00';
        $now = Carbon::now('+07:00');
        if (($diff = $time->diffInYears($now)) > 0)
            return "$diff year(s) ago";
        else if (($diff = $time->diffInMonths($now)) > 0)
            return "$diff month(s) ago";
        else if (($diff = $time->diffInDays($now)) > 0)
            return "$diff day(s) ago";
        else if (($diff = $time->diffInHours($now)))
            return "$diff hours ago";
        else if (($diff = $time->diffInMinutes($now)) > 0)
            return $diff."m ago";
        else
            return "Moments ago";
    }
}
