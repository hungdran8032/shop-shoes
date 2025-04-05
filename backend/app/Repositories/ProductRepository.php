<?php
namespace App\Repositories;

use App\Models\Product;
use App\Models\Image;
use App\Models\ProductStock;
use Illuminate\Support\Facades\DB;

class ProductRepository
{
    protected $model;
    public function __construct(Product $model){
        $this->model = $model;
    }
    
    public function getAllProducts()
    {
        return $this->model->with(['brand', 'category', 'images', 'stocks.color', 'stocks.size'])->get();
    }

    public function getProductById($id)
    {
        return $this->model->with(['brand', 'category', 'images', 'stocks.color', 'stocks.size'])->find($id);
    }

    public function createProduct(array $data, array $imageLinks, array $stocks)
    {
        DB::beginTransaction();
        try {
            $product = $this->model->create($data);

            // Tạo images (nếu có)
            if (!empty($imageLinks)) {
                foreach ($imageLinks as $link) {
                    Image::create([
                        'productId' => $product->id,
                        'link' => $link
                    ]);
                }
            }

            // Tạo stocks (nếu có)
            if (!empty($stocks)) {
                foreach ($stocks as $stock) {
                    ProductStock::create([
                        'productId' => $product->id,
                        'colorId' => $stock['colorId'],
                        'sizeId' => $stock['sizeId'],
                        'quantity' => $stock['quantity'],
                    ]);
                }
            }

            return $product; 
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateProduct($id, array $data)
    {
        $product = $this->model->find($id);
        if ($product) {
            $product->update($data);
            return $this->model->with(['brand', 'category', 'images', 'stocks.color', 'stocks.size'])
                ->find($id);
        }
        return null;
    }

    public function deleteProduct($id)
    {
        $product = $this->model->find($id);
        if ($product) {
            $product->delete();
        }
        return $product;
    }
}