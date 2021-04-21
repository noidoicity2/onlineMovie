<?php


namespace App\Repositories;


use App\Models\MovieView;
use Illuminate\Database\Eloquent\Model;

class MovieViewRepository extends BaseRepository implements Interfaces\MovieViewRepositoryInterface
{
public function __construct(MovieView $model)
{
    parent::__construct($model);
}

    public function get($id)
    {
        // TODO: Implement get() method.
        return $this->model->find($id);
    }
}
