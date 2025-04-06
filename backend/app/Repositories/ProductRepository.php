<?php
namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    protected $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function getById($id)
{
    return $this->model->with([
        'brand',
        'category',
        'images',
        'stocks.color',
        'stocks.size'
    ])->find($id);
}

    public function getAllProducts()
    {
        return$this->model->with([
            'brand',         
            'category',        // Quan hệ với Category
            'images',          // Quan hệ với Image
            'stocks.color',    // Quan hệ với ProductStock và Color
            'stocks.size'      // Quan hệ với ProductStock và Size
        ])->get();
    }

    public function createProduct(array $data)
    {
        $product = $this->model->create($data);
        return $product;

    }
}