<?php
namespace App\Services;

use App\Repositories\ProductStockRepository;
use Illuminate\Http\Request;

class ProductStockService
{
    protected $productStockRepository;

    public function __construct(ProductStockRepository $productStockRepository)
    {
        $this->productStockRepository = $productStockRepository;
    }

    public function getAll()
    {
        return $this->productStockRepository->getAll();
    }

    public function findById($id)
    {
        return $this->productStockRepository->findById($id);
    }

    public function create(Request $request)
    {
        $data = $request->only(['productId', 'colorId', 'sizeId', 'quantity']);
        if (!\App\Models\Product::find($data['productId'])) {
            throw new \Exception('Invalid product ID');
        }
        if (!\App\Models\Color::find($data['colorId'])) {
            throw new \Exception('Invalid color ID');
        }
        if (!\App\Models\Size::find($data['sizeId'])) {
            throw new \Exception('Invalid size ID');
        }
        if (!is_numeric($data['quantity']) || $data['quantity'] < 0) {
            throw new \Exception('Invalid quantity');
        }

        return $this->productStockRepository->create($data);
    }

    public function update($id, Request $request)
    {
        $data = $request->only(['productId', 'colorId', 'sizeId', 'quantity']);
        return $this->productStockRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->productStockRepository->delete($id);
    }
}