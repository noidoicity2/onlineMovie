<?php


namespace App\Repositories;


use App\Models\Movie;

class MovieCategoryRepository implements Interfaces\MovieCategoryInterface
{

    public function get($id)
    {
        // TODO: Implement get() method.
        return Movie::find($id);
    }

    public function all()
    {
       return Movie::all();
    }

    public function update($id, array $data)
    {
        // TODO: Implement update() method.
        return Movie::find($id)->update($data);
    }

    public function delete($id): int
    {
        return Movie::destroy($id);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        // TODO: Implement create() method.
    }
}
