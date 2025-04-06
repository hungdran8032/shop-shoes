<?php
// app/Repositories/ColorRepository.php
namespace App\Repositories;

use App\Models\Color;

class ColorRepository
{
    protected $model;

    public function __construct(Color $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $color = $this->find($id);
        if ($color) {
            $color->update($data);
            return $color;
        }
        return null;
    }

    public function delete($id)
    {
        $color = $this->find($id);
        if ($color) {
            return $color->delete();
        }
        return false;
    }
}
