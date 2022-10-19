<?php
namespace App\Http\Repositories\Product;

interface ProductRepositoryInterface
{
    public function getModel();

    /**
     * Set model
     */
    public function setModel();

    /**
     * Get All
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll();

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Get one
     * @param $id
     * @return mixed or 404 if null.
     */
    public function findOrFail($id);

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes);

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id);
}
