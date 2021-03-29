<?php


namespace App\Repositories\Interfaces;
//namespace App\Repositories;


interface MovieRepositoryInterface extends BaseRepositoryInterface{
    public function listMovie($paginate, $orderBy) ;

}
