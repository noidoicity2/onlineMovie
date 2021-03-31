<?php


namespace App\Repositories;



use App\Models\MovieCategory;
use Illuminate\Support\Collection;

class MovieCategoryRepository implements Interfaces\MovieCategoryInterface
{

    public function get($id)
    {
        // TODO: Implement get() method.
        return MovieCategory::find($id);
    }

//    public function all()
//    {
//       return MovieCategory::all();
//    }

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
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        // TODO: Implement create() method.

    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        // TODO: Implement all() method.
    }
}
