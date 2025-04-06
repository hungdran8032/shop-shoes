<?php
namespace App\Repositories;

use App\Models\Size;

class SizeRepository
{
    protected $model;

    public function __construct(Size $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function findById($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $size = $this->model->find($id);
        if ($size) {
            $size->update($data);
            return $size;
        }
        return null;
    }

    public function delete($id)
    {
        $size = $this->model->find($id);
        if ($size) {
            $size->delete();
            return true;
        }
        return false;
    }
}