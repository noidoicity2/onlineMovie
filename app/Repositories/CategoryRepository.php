<?php


namespace App\Repositories;


use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Database\QueryException;


class CategoryRepository implements CategoryRepositoryInterface
{

    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        // TODO: Implement get() method.
    }

    /**
     * @return mixed
     */
    public function all()
    {
        // TODO: Implement all() method.
        return Category::all();
    }

    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
//     Category::findOrFail($id);

        return Category::destroy($id);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
            Category::create($data);
//        CATEGORY_VIEW_DIR
    }



}
