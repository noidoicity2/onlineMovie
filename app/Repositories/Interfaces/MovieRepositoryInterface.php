<?php


namespace App\Repositories\Interfaces;
//namespace App\Repositories;


interface MovieRepositoryInterface extends BaseRepositoryInterface{
    public function listMovie($paginate, $orderBy) ;
    public function getSeriesMovies() ;
    public function getFinishedMovies() ;
    public function getCinemaMovies();
    public function getFreeMovies();
    public function getMovieByImdb($imdb);
    public function getMoviesBySlug($slug);
    public function getMovieByCategories($categories);
    public function getMostViewedMovie();
    public  function getMovieByCountryId($id);
    public function where($array);



}
