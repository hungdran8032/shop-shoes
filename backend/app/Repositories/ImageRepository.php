<?php
namespace App\Repositories;

use App\Models\Image;

class ImageRepository
{
    protected $model;

    public function __construct(Image $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->with('product')->get();
    }

    public function findById($id)
    {
        return $this->model->with('product')->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $image = $this->findById($id);
        $image->update($data);
        return $image;
    }

    public function delete($id)
    {
        $image = $this->findById($id);
        $image->delete();
        return true;
    }
}