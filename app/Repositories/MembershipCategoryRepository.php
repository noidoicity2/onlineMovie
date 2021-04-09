<?php


namespace App\Repositories;


use App\Models\MembershipCategory;
use Illuminate\Database\Eloquent\Model;

class MembershipCategoryRepository extends BaseRepository implements Interfaces\MembershipCategoryRepositoryInterface
{
public function __construct(MembershipCategory $model)
{
    parent::__construct($model);
}

    public function get($id)
    {
        // TODO: Implement get() method.
        return $this->model->find($id);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function insert($data)
    {
        // TODO: Implement insert() method.
        return $this->model->insert($data);
    }
}
