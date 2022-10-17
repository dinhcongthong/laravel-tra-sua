<?php
namespace App\Http\Repositories\StoreStatus;

interface StoreStatusRepositoryInterface
{
    public function getModel();
    public function getAll();
    public function find($id);
    public function create(array $attributes);
    public function update($id, array $attributes);
    public function delete($id);
    public function initStore();
}
