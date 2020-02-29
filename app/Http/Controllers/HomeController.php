<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Requests\Home\CreateThreadPostRequest;
use App\Service\Contracts\IHomeService;

class HomeController extends Controller
{
    private $homeService;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(IHomeService $homeService)
    {
        $this->homeService = $homeService;
        $this->middleware('auth')->except(['index', 'threads']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = $this->homeService->GetCategories();
        $subCategories = $this->homeService->GetSubCategories();
        $user = Auth::user();
        $showCreate = !is_null($user);
        $canCreate = ($showCreate && !is_null($user->email_verified_at));
        return view('home')->with([
            'isHome' => true,
            'categories' => $categories,
            'subCategories' => $subCategories,
            'canCreate' => $canCreate,
            'showCreate' => $showCreate
        ]);
    }

    /**
     * Return threads based on given subcategory
     * 
     * @param int subCategoryId
     * @return \Illuminate\Http\JsonResponse
     */
    public function threads($subCategoryId)
    {
        $threads = $this->homeService->GetThreadsBySubCategory($subCategoryId);
        return response()->json([
            "threads" => $threads,
        ]);
    }

    /**
     * Return create thread view component
     * 
     * @param int subCategoryId
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function createThread($subCategoryId)
    {
        $user = Auth::user();
        $subCategory = $this->homeService->GetSubcategoryByID($subCategoryId);

        $action = collect([
            'title' => "Create Thread in {$subCategory['name']}",
            'user' => $this->homeService->GetUserForPostComponent($user->id)
        ]);

        return view('components.home.thread.action')->with([
            'createThread' => true,
            'action' => $action,
            'subCategoryId' => $subCategoryId
        ]);
    }

    /**
     * Make and save submitted thread
     * 
     * @param \App\Model\Requests\Home\CreateThreadPostRequest request
     * @param int subCategoryId
     * @return \Illuminate\Http\JsonResponse
     * 
     * @throws Exception
     */
    public function saveThread(CreateThreadPostRequest $request, $subCategoryId)
    {
        $data = $request->intoCollection();
        $data = $data->merge([
            "user_id" => Auth::id(),
            "subcategory_id" => $subCategoryId
        ]);
        $response = [
            "success" => true,
            "message" => null
        ];
        try {
            $thread = $this->homeService->SaveThread($data);
            if (is_null($thread))
                throw new Exception();
            else
                $response["message"] = "Thread created successfully";
        } catch (Exception $e) {
            $response["success"] = false;
            $response["message"] = "Fail to create thread";
        }
        return response()->json($response);
    }
}
