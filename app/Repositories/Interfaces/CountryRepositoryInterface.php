<?php


namespace App\Repositories\Interfaces;


interface CountryRepositoryInterface extends BaseRepositoryInterface
{
    public function getCountryForSelect() ;
    public function getAllCountry();
    public function Paginate($numberPerpage);
    public function Select($colums);
}
