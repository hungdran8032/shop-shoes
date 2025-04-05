<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAllProducts()
    {
        return $this->productRepository->getAllProducts();
    }

    public function getProductById($id)
    {
        return $this->productRepository->getProductById($id);
    }

    public function createProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'link' => 'required|string',
            'price' => 'required|numeric',
            'hot' => 'boolean',
            'sale' => 'numeric',
            'description' => 'nullable|string',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,webp|max:5120',
            'stocks' => 'nullable|array',
            'stocks.*.color_id' => 'required|exists:colors,id',
            'stocks.*.size_id' => 'required|exists:sizes,id',
            'stocks.*.quantity' => 'required|integer',
        ]);

        $imageLinks = [];
        foreach ($request->file('images') as $file) {
            $path = $file->store('assets/uploads/demo', 'public');
            $imageLinks[] = $path;
        }

        return $this->productRepository->createProduct($validated, $imageLinks, $request->input('stocks'));
    }

    public function updateProduct($id, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'link' => 'required|string',
            'price' => 'required|numeric',
            'hot' => 'boolean',
            'sale' => 'numeric',
            'description' => 'nullable|string',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        return $this->productRepository->updateProduct($id, $validated);
    }

    public function deleteProduct($id)
    {
        return $this->productRepository->deleteProduct($id);
    }
}
?>