<?php


namespace App\Repositories;


use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\DirectorRepositoryInterface;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use App\Repositories\Interfaces\MembershipCategoryRepositoryInterface;
use App\Repositories\Interfaces\MembershipRepositoryInterface;
use App\Repositories\Interfaces\MovieCategoryRepositoryInterface;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use App\Repositories\Interfaces\MovieViewRepositoryInterface;
use App\Repositories\Interfaces\PaymentMethodRepositoryInterface;
use App\Repositories\Interfaces\SlideRepositoryInterface;
use App\Repositories\Interfaces\TransactionRepositoryInterface;
use App\Repositories\Interfaces\UserMembershipRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
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
        $this->app->bind(PaymentMethodRepositoryInterface::class , PaymentMethodRepository::class);
        $this->app->bind(MembershipRepositoryInterface::class , MembershipRepository::class);
        $this->app->bind(MembershipCategoryRepositoryInterface::class , MembershipCategoryRepository::class);

        $this->app->bind(UserRepositoryInterface::class , UserRepository::class);
        $this->app->bind(UserMembershipRepositoryInterface::class , UserMembershipRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class , TransactionRepository::class);
        $this->app->bind(MovieViewRepositoryInterface::class , MovieViewRepository::class);
    }

}
