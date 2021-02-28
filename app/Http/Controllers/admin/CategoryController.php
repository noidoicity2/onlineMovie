<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
//use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\AddCategoryRequest;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface  $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function PostAddCategory (AddCategoryRequest $request)
    {
        $this->categoryRepository->create($request->validated());
//        Category::create([$request->validated()]);
//        $rq = $request->validated();
//        $arr = $rq
        return $request->validated();
//        return "add success";


    }
}
