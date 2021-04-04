<?php


namespace App\Repositories;


use App\Models\Director;
use Illuminate\Database\Eloquent\Model;

class DirectorRepository extends BaseRepository implements Interfaces\DirectorRepositoryInterface
{
    public function __construct(Director $model)
    {
        parent::__construct($model);
    }

    public function get($id)
    {
        // TODO: Implement get() method.
        return $this->model->find($id);
    }
}
