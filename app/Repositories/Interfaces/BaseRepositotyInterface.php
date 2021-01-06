<?php


namespace App\Repositories\Interfaces;


interface BaseRepositotyInterface
{
    public function get($id);

    public function all();

    public function update($id, array $data);

    public function delete($id);
}
