<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function list()
    {
        return $this->productService->getAllProducts(); 
    }

    public function create(ProductRequest $request)
    {
        return $this->productService->createProduct($request->validated());
    }

    public function show($id)
    {
        return $this->productService->getProductById($id);
    }

    public function update(ProductRequest $request, $id)
    {
        return $this->productService->updateProduct($id, $request->validated());
    }

    public function destroy($id)
    {
        return $this->productService->deleteProduct($id);
    }
}
