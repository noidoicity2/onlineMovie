<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\AddCategoryRequest;
use App\Http\Requests\Category\DeleteCategoryRequest;
use App\Http\Requests\Category\EditCategoryRequest;
use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Psy\Util\Json;
use  App\Constant;

//const CATEGORY_VIEW_DIR = "admin.page.category.";

class CategoryController extends Controller
{
    //
    protected $categoryRepository;
    protected $category_view_url =  "admin.page.category.";



    public function __construct(CategoryRepositoryInterface  $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function All() {


        return view($this->category_view_url.'listCategories', [

                'categories'    =>  $this->categoryRepository->all(),
                'title'         =>  "All category"
            ]

        );
    }

    public function Edit($id=null) {
        if(!isset($id)) return redirect()->route("list_category");
        $category =  $this->categoryRepository->get($id) ;
        return view($this->category_view_url."editCategory" , [
           'category' => $category,
        ]);


    }
    public function PostAddCategory (AddCategoryRequest $request)
    {
        try{
            $this->categoryRepository->create($request->validated());
        }
        catch (QueryException $e) {
            return $e->getMessage();
        }

        return back()->with([
            'message' =>  "Add category successfully"
        ]);



    }



    public function PostDeleteCategory(DeleteCategoryRequest $request) {

        $row_affect  = $this->categoryRepository->delete($request->id);
        if($row_affect>0) return json_encode([
            'success' => true
        ]);
        else return json_encode([
            'success' => false
        ]);

    }

    public function PostEditCategory(EditCategoryRequest $request) {
        $row_affect = $this->categoryRepository->update($request->id , $request->except(['id']));
        if($row_affect>0)  return back()->with([
            'message' =>  "update category successfully"
        ]);
        else  return back()->with([
            'message' =>  "Cannot update category"
        ]);
    }
}
