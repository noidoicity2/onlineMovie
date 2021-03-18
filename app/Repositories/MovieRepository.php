<?php


namespace App\Repositories;


//use App\Repositories\MovieRepositoryInterface;

use App\Models\Movie;
use App\Repositories\Interfaces\MovieRepositoryInterface;

class MovieRepository implements MovieRepositoryInterface
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
        return Movie::create($data);
    }
}
