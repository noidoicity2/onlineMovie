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
//        $data['is_movie18'] =   $data['is_movie18']=='on' ? 1 : 0;
//        $data['is_finished'] =   $data['is_finished']=='on' ? 1 : 0;
//        $data['is_movie_series'] =   $data['is_movie_series']=='on' ? 1 : 0;
//        $data['is_on_cinema'] =   $data['is_on_cinema']=='on' ? 1 : 0;
        return Movie::create($data);
    }
}
