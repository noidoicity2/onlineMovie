<?php


namespace App\Repositories;


use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
    public function  register()
    {
        $this->app->bind(MovieRepositoryInterface::class    ,   MovieRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class ,   CategoryRepository::class);
    }

}
