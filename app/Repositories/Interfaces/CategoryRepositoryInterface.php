<?php


namespace App\Repositories\Interfaces;


interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    public  function  getCategoryForSelect();
    public function getTotalCategory();
}
