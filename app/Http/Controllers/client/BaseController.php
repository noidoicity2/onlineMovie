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


    protected  $countryRepository;
    //
    public function __construct(EpisodeRepositoryInterface $episodeRepository ,
                                CountryRepositoryInterface $countryRepository)
    {

        $this->categories = Category::OnLyName()->get()->take(10);
        $this->countries = $this->countryRepository->getCountryForSelect()->take(5)->get();
    }
}
