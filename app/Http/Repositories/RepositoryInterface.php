<?php

namespace App\Http\Repositories;

interface RepositoryInterface
{
    /**
     * Get all
     * @return mixed
     */
    public function getAll();

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id);

    public function findOrFail($id);

    public function first();

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Create Many
     * @param array $attributes
     * @return mixed
     */
    public function createMany(array $attributes);

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, array $attributes);

    public function updateOrCreate (array $condition, array $attributes);
    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id);
}
