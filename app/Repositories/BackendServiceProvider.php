<?php


namespace App\Repositories;


use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\DirectorRepositoryInterface;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use App\Repositories\Interfaces\MovieCategoryRepositoryInterface;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use App\Repositories\Interfaces\SlideRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    public function  register()
    {
        $this->app->bind(MovieRepositoryInterface::class    ,   MovieRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class ,   CategoryRepository::class);
        $this->app->bind(CountryRepositoryInterface::class ,   CountryRepository::class);
        $this->app->bind(MovieCategoryRepositoryInterface::class ,   MovieCategoryRepository::class);
        $this->app->bind(EpisodeRepositoryInterface::class , EpisodeRepository::class);
        $this->app->bind(DirectorRepositoryInterface::class , DirectorRepository::class);
        $this->app->bind(SlideRepositoryInterface::class , SlideRepository::class);


    }

}
