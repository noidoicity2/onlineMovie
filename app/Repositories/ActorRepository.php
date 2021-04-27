<?php


namespace App\Repositories;


use App\Repositories\Interfaces\ActorRepositoryInterface;
use Illuminate\Support\Collection;

class ActorRepository implements ActorRepositoryInterface
{

    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        // TODO: Implement get() method.
    }



    /**
     * @param $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
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
