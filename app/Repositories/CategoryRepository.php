<?php


namespace App\Repositories;


use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\QueryException;


class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param Category $model
     */
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        // TODO: Implement get() method.
        return Category::find($id);
    }

    /**
     * @return mixed
     */
//    public function all()
//    {
//        // TODO: Implement all() method.
//        return Category::all();
//    }




    /**
     * @param $id
     * @return mixed
     */
//    public function delete($id)
//    {
////     Category::findOrFail($id);
//
//        return Category::destroy($id);
//    }

    /**
     * @param $data
     * @return mixed
     */
//    public function create($data)
//    {
//            Category::create($data);
////        CATEGORY_VIEW_DIR
//    }



}
