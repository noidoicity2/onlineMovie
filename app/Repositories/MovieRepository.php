<?php


namespace App\Repositories;


//use App\Repositories\MovieRepositoryInterface;

use App\Models\Movie;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;


class MovieRepository extends BaseRepository implements MovieRepositoryInterface
{

    public function __construct(Movie $model)
    {
        parent::__construct($model);
    }

    public function get($id)
    {
        // TODO: Implement get() method.
        return Movie::find($id);
    }

//    public function all()
//    {
//        return Movie::all();
//    }

//    public function update($id, array $data)
//    {
//        // TODO: Implement update() method.
//        return Movie::find($id)->update($data);
//    }

//    public function delete($id): int
//    {
//        return Movie::destroy($id);
//    }

    /**
     * @param $data
     * @return mixed
     */
//    public function create($data)
//    {
//
//        // TODO: Implement create() method.
////        $data['is_movie18'] =   $data['is_movie18']=='on' ? 1 : 0;
////        $data['is_finished'] =   $data['is_finished']=='on' ? 1 : 0;
////        $data['is_movie_series'] =   $data['is_movie_series']=='on' ? 1 : 0;
////        $data['is_on_cinema'] =   $data['is_on_cinema']=='on' ? 1 : 0;
//        return Movie::create($data);
//    }
    /**
     * @param $paginate
     * @param $orderBy
     * @return Collection
     */
    public function listMovie($paginate , $orderBy)
    {
        // TODO: Implement listMovie() method.
        return $this->model->orderBy('created_at' , $orderBy)->paginate($paginate);
    }

    /**
     * @return mixed
     */
    public function getSeriesMovies()
    {
        // TODO: Implement getSeriesMovies() method.
        return $this->model->where('is_movie_series' ,1)
            ->select('name' , 'id' ,'en_name' , 'img' , 'is_free' ,'slug')
            ->orderBy('created_at' , 'desc')->paginate(20);
    }

    /**
     * @return mixed
     */
    public function getFinishedMovies()
    {
        // TODO: Implement getFinishedMovies() method.
        return $this->model->where('is_finished' ,1)->paginate(10);
    }

    /**
     * @return mixed
     */
    public function getCinemaMovies()
    {
        // TODO: Implement getCinemaMovies() method.
        return $this->model->where('is_on_cinema' , 1)->paginate(4);
    }

    /**
     * @return mixed
     */
    public function getFreeMovies()
    {
        // TODO: Implement getFreeMovies() method.
        return $this->model->where('is_free' ,1)->paginate(10);
    }

    /**
     * @param $imdb
     * @return mixed
     */
    public function getMovieByImdb($imdb)
    {
        // TODO: Implement getMovieByImdb() method.
        return $this->model->where('imdb' ,$imdb)->paginate(10);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getMoviesBySlug($slug)
    {
        // TODO: Implement getMoviesBySlug() method.
        return $this->model->whereSlug($slug)->paginate(10);
    }

    /**
     * @param $categories
     * @return mixed
     */
    public function getMovieByCategories($categoryID)
    {
        // TODO: Implement getMovieByCategories() method.
        return $this->model->categories->find($categoryID);
    }

    /**
     * @return mixed
     */
    public function getMostViewedMovie()
    {
        // TODO: Implement getMostViewedMovie() method.
        return $this->model->orderBy('view_count', 'desc');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getMovieByCountryId($id)
    {
        // TODO: Implement getMovieByCountryId() method.
//        return $this->model->
    }

    public function where($array)
    {
        // TODO: Implement where() method.
        return $this->model->where($array);
    }

    /**
     * @return mixed
     */
    public function getLatestMovie()
    {

        // TODO: Implement getLastestMovie() method.
        return $this->model->orderBy('created_date' , 'desc')->paginate(10);

    }

    /**
     * @return mixed
     */
    public function getTotalMovie()
    {
        // TODO: Implement getTotalMovie() method.
        return $this->model->count();
    }
}
