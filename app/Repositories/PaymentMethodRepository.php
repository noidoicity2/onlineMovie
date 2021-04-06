<?php


namespace App\Repositories;


use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Model;

class PaymentMethodRepository extends BaseRepository implements Interfaces\PaymentMethodRepositoryInterface
{
    public function __construct(PaymentMethod $model)
    {
        parent::__construct($model);
    }

    public function get($id)
    {
        // TODO: Implement get() method.
        return $this->model->find($id);
    }
}
