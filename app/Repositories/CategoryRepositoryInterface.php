<?php
namespace App\Repositories;

interface CategoryRepositoryInterface
{
    public function getAll();
    public function create(array $data);
    public function find($id);
    public function update($id, array $data);
    public function delete($id);
    public function restore($id);
}
