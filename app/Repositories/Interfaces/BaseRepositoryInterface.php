<?php


namespace App\Repositories\Interfaces;


interface BaseRepositoryInterface
{
    public function get($id);

    public function all();

    public function update($id, array $data);

    public function delete($id);
}
