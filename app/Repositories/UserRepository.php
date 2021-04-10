<?php


namespace App\Repositories;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository implements Interfaces\UserRepositoryInterface
{
public function __construct(User $model)
{
    parent::__construct($model);
}

    public function get($id)
    {
        // TODO: Implement get() method.
        return $this->model->find($id);
    }
}
