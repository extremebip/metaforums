<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
}
