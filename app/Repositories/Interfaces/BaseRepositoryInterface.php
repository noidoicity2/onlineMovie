<?php


namespace App\Repositories\Interfaces;


use Illuminate\Support\Collection;


interface BaseRepositoryInterface
{
    public function get($id);

    public function all():Collection;

    public function update($id, array $data);

    public function delete($id);

    public function create(array $data);
}
