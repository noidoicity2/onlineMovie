<?php


namespace App\Repositories;


use App\Models\Slider;
use App\Repositories\Interfaces\SlideRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class SlideRepository extends BaseRepository implements SlideRepositoryInterface
{
    public function __construct(Slider $model)
    {
        parent::__construct($model);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        // TODO: Implement get() method.
        return $this->model->find($id);
    }







}
