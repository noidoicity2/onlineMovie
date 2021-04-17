<?php


namespace App\Repositories;


use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;

class TransactionRepository extends BaseRepository implements Interfaces\TransactionRepositoryInterface
{
    public function __construct(Transaction $model)
    {
        parent::__construct($model);
    }

    public function get($id)
    {
        // TODO: Implement get() method.
        return $this->find($id);
    }

    public function getRevenueThisWeek()
    {
        // TODO: Implement getRevenueThisWeek() method.
    }

    public function getTotalRevenue()
    {
        // TODO: Implement getTotalRevenue() method.
        return $this->model->select('total_amount')->where('status' , 'success')->sum('total_amount');
    }

    public function getRevenueThisMonth()
    {
        // TODO: Implement getRevenueThisMonth() method.
    }

    public function getRevenueToday()
    {
        // TODO: Implement getRevenueToday() method.
    }

    public function getRevenueBetween($from, $to)
    {
        // TODO: Implement getRevenueBetween() method.
    }

    public function getRevenueInMonth($month)
    {
        // TODO: Implement getRevenueInMonth() method.
    }
}
