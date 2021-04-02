<?php


namespace App\Repositories;



use App\Models\MovieCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class MovieCategoryRepository extends BaseRepository implements Interfaces\MovieCategoryRepositoryInterface
{
public function __construct(MovieCategory $model)
{
    parent::__construct($model);
}

    public function get($id)
    {
        // TODO: Implement get() method.
        return MovieCategory::find($id);
    }


    public function update($id, array $data)
    {
        // TODO: Implement update() method.
        return MovieCategory::find($id)->update($data);
    }

    public function delete($id): int
    {
        return MovieCategory::destroy($id);
    }

    /**
     * @return mixed
     */
    public function insert($data)
    {
        // TODO: Implement insert() method.
        return $this->model->insert($data);
    }
}
