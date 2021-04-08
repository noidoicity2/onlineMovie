<?php


namespace App\Repositories;


use App\Models\Membership;
use Illuminate\Database\Eloquent\Model;

class MembershipRepository extends BaseRepository implements Interfaces\MembershipRepositoryInterface
{
public function __construct(Membership $model)
{
    parent::__construct($model);
}

    public function get($id)
    {
        // TODO: Implement get() method.
        return $this->model->find($id);
    }
}
