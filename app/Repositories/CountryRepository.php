<?php


namespace App\Repositories;


use App\Models\Country;

class CountryRepository implements Interfaces\CountryRepositoryInterface
{

    public function get($id)
    {
        // TODO: Implement get() method.
        return Country::find($id);
    }

    public function all()
    {
        // TODO: Implement all() method.
        return Country::all();
    }

    public function update($id, array $data)
    {
        // TODO: Implement update() method.
        return Country::find($id)->update($data);
    }

    public function delete($id): int
    {
        // TODO: Implement delete() method.
        return Country::destroy($id);
    }

    /**
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        // TODO: Implement create() method.
    }
}
