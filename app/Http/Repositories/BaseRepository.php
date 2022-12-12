<?php

namespace App\Http\Repositories;

use App\Http\Repositories\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    /**
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * EloquentRepository constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * get model
     * @return string
     */
    abstract public function getModel();

    /**
     * Set model
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    /**
     * Get All
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    /**
     * Get one
     * @param $id
     * @return mixed or 404 if null.
     */
    public function findOrFail($id)
    {
        $result = $this->model->findOrFail($id);

        return $result;
    }

    public function first() {
        return $this->model->first();
    }

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {

        return $this->model->create($attributes);
    }

    /**
     * Create Many
     * @param array $attributes
     * @return mixed
     */
    public function createMany(array $attributes)
    {

        return $this->model->createMany($attributes);
    }

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return bool|mixed
     */
    public function update($id, array $attributes)
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    public function updateOrCreate (array $condition, array $attributes) {
        return $this->model->updateOrCreate($condition, $attributes);
    }

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }
}
