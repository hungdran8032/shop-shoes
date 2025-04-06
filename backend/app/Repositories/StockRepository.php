<?php
namespace App\Repositories;

use App\Models\ProductStock;

class StockRepository
{
    protected $model;

    public function __construct(ProductStock $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->with(['product', 'color', 'size'])->get();
    }

    public function findById($id)
    {
        return $this->model->with(['product', 'color', 'size'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $stock = $this->findById($id);
        $stock->update($data);
        return $stock;
    }

    public function delete($id)
    {
        $stock = $this->findById($id);
        $stock->delete();
        return true;
    }
}