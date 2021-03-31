<?php


namespace App\Repositories;


use App\Models\Country;
use Illuminate\Database\Eloquent\Model;

class CountryRepository extends BaseRepository implements Interfaces\CountryRepositoryInterface
{

    public function __construct(Country $model)
    {
        parent::__construct($model);
    }

    public function get($id)
    {
        // TODO: Implement get() method.
        return Country::find($id);
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
   public function getCountryForSelect() {
       return $this->model->select(['id', 'name']);
   }
}
