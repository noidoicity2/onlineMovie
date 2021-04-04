<?php


namespace App\Repositories;


use App\Models\Episode;
use Illuminate\Database\Eloquent\Model;

class EpisodeRepository extends BaseRepository implements Interfaces\EpisodeRepositoryInterface
{

    public function __construct(Episode $model)
    {
        parent::__construct($model);
    }

    public function get($id)
    {
        // TODO: Implement get() method.
        return $this->model->find($id);
    }
}
