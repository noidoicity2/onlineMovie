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

    /**
     * @return mixed
     */
    public function getAllCountry()
    {
        // TODO: Implement getAllCountry() method.
        return $this->model->paginate(10);
    }
    public function Paginate($numberPerPage) {
        return $this->model->paginate($numberPerPage);
    }

    public function Select($columns)
    {
        // TODO: Implement Select() method.
        return $this->model->select($columns);
    }
}
