<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use App\Repositories\Interfaces\MovieRepositoryInterface;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $categories;
    protected $countries;
    protected  $movieRepository;
    protected  $countryRepository;
    //
    public function __construct(MovieRepositoryInterface $movieRepository,
                                CountryRepositoryInterface $countryRepository)
    {

        $this->movieRepository = $movieRepository;
        $this->countryRepository = $countryRepository;
        $this->categories = Category::OnLyName()->get()->take(10);
        $this->countries = $this->countryRepository->all()->take(5);
    }
}
