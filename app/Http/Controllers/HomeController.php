<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('home')->with([
            'isHome' => true,
            'categories' => $categories,
            'subCategories' => $subCategories
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
        // $threads = $this->homeService->GetThreadsBySubCategory($subCategoryId);
        $threads = [
            [
                'hot' => true,
                'title' => 'Fifty Shades of grey',
                'author' => 'jon',
                'views' => 125,
                'comments' => 56,
                'lastUpdate' => 'Moments Ago'
            ],
            [
                'hot' => false,
                'title' => 'Fifty Shades of white',
                'author' => 'bertz',
                'views' => 100,
                'comments' => 12,
                'lastUpdate' => 'One day Ago'
            ],
        ];
        return response()->json([
            "threads" => $threads
        ]);
    }
}
