<?php

namespace App\Service\Modules;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Helper\Time\TimeConverter;
use App\Model\DB\Thread;
use App\Model\DB\Post;
use App\Model\DB\PostReply;
use App\Repository\Contracts\ICategoryRepository;
use App\Repository\Contracts\ISubCategoryRepository;
use App\Repository\Contracts\IThreadRepository;
use App\Repository\Contracts\IPostRepository;
use App\Repository\Contracts\IPostReplyRepository;
use App\Repository\Contracts\IUserRepository;
use App\Repository\Contracts\IUserLoginRepository;
use App\Service\Contracts\IHomeService;

class HomeService implements IHomeService
{
    private $categoryRepository;
    private $subCategoryRepository;
    private $threadRepository;
    private $postRepository;
    private $postReplyRepository;
    private $userRepository;
    private $userLoginRepository;

    public function __construct(
        ICategoryRepository $categoryRepository, 
        ISubCategoryRepository $subCategoryRepository,
        IThreadRepository $threadRepository,
        IPostRepository $postRepository,
        IPostReplyRepository $postReplyRepository,
        IUserRepository $userRepository,
        IUserLoginRepository $userLoginRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->subCategoryRepository = $subCategoryRepository;
        $this->threadRepository = $threadRepository;
        $this->postRepository = $postRepository;
        $this->postReplyRepository = $postReplyRepository;
        $this->userRepository = $userRepository;
        $this->userLoginRepository = $userLoginRepository;
    }

    public function GetCategories()
    {
        return $this->categoryRepository->FindAll()->withoutTimestamp();
    }

    public function GetSubCategories()
    {
        return $this->subCategoryRepository->FindAll()->withoutTimestamp();
    }

    public function GetSubcategoryByID($subCategoryId){
        return $this->subCategoryRepository->Find($subCategoryId);
    }

    public function GetThreadsBySubCategory($subCategoryId)
    {
        $DBthreads = $this->threadRepository->FindAllBySubCategory($subCategoryId);
        if (is_null($DBthreads))
            return null;
        return $DBthreads->map(function ($item, $key)
        {
            $user = $this->userRepository->Find($item->user_id);
            $comments = $this->postReplyRepository->FindAllByThreadOrderByLatestCreatedAt($item->id);
            return [
                'hot' => false,
                'title' => $item->title,
                'author' => $user->username,
                'views' => $item->view_count,
                'comments' => $comments->count(),
                'lastReply' => TimeConverter::ToPastString($comments->first()->created_at)
            ];
        });
    }

    public function GetUserForPostComponent($userId){
        $user = $this->userRepository->Find($userId);
        $userLogin = $this->userLoginRepository->FindByUserIDOrderByLatestTimeLogin($userId);
        $postCount = $this->postRepository->FindAllByUser($userId)->count();

        return [
            'username' => $user->username,
            'onlineStatus' => is_null($userLogin->logout_time) ? 'Online' : 'Offline',
            'role' => 'User',
            'postCount' => $postCount,
            'lastLogin' => TimeConverter::ToPastString($userLogin->time_login),
            'moderationType' => 'Active'
        ];
    }

    public function SaveThread($data){
        $thread = new Thread();
        $thread->fill([
            'user_id' => $data['user_id'],
            'title' => $data['title'],
            'subcategory_id' => $data['subcategory_id'],
            'view_count' => 0
        ]);

        $post = new Post();
        $post->fill([
            'user_id' => $data['user_id'],
            'content' => $data['content']
        ]);

        $postReply = new PostReply();

        return DB::transaction(function () use ($thread, $post, $postReply)
        {
            $newThread = $this->threadRepository->InsertUpdate($thread);
            $newPost = $this->postRepository->InsertUpdate($post);

            $postReply->fill([
                'thread_id' => $newThread->id,
                'reply_post_id' => $newPost->id,
            ]);
            $this->postReplyRepository->InsertUpdate($postReply);
            return $newThread;
        });
    }
}
