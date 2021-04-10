<?php


namespace App\Repositories;


use App\Models\UserMembership;
use Illuminate\Database\Eloquent\Model;

class UserMembershipRepository extends BaseRepository implements Interfaces\UserMembershipRepositoryInterface
{
public function __construct(UserMembership $model)
{
    parent::__construct($model);
}

    public function get($id)
    {
     return $this->model->find($id);
    }
}
