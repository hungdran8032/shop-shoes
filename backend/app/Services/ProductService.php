<?php
namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAll()
    {
        return $this->productRepository->getAll();
    }

    public function findById($id)
    {
        return $this->productRepository->findById($id);
    }

    public function create(Request $request)
    {
        $productData = [
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'hot' => (int) filter_var($request->input('hot'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? 0,
            'sale' => (int) filter_var($request->input('sale'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? 0,
            'description' => $request->input('description'),
            'brandId' => $request->input('brandId'),
            'categoryId' => $request->input('categoryId'),
        ];

        return $this->productRepository->create($productData);
    }

    public function update($id, Request $request)
    {
        $productData = $request->only(['name', 'price', 'hot', 'sale', 'description', 'brandId', 'categoryId']);
        return $this->productRepository->update($id, $productData);
    }

    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }
}