<?php


namespace App\Repositories\Interfaces;


interface TransactionRepositoryInterface extends  BaseRepositoryInterface
{
    public function getRevenueThisWeek();
    public function getTotalRevenue();
    public function getRevenueThisMonth();
    public function getRevenueToday();
    public function getRevenueBetween($from , $to);
    public function getRevenueInMonth($month);
}
