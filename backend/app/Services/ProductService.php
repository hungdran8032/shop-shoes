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
        \Log::info('Dữ liệu nhận được từ request: ', $request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'hot' => 'required|nullable|boolean',
            'sale' => 'required|nullable|boolean',
            'description' => 'nullable|string',
            'brandId' => 'required|exists:brands,id',
            'categoryId' => 'required|exists:categories,id',
            'images' => 'nullable|array|max:5',
            'images.*' => 'image|mimes:jpeg,png,webp|max:5120',
            'stocks' => 'required|string',
        ]);

        $imageLinks = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('assets/uploads/demo', 'public');
                $fileName = basename($path);
                $relativePath = "uploads/demo/{$fileName}";
                $imageLinks[] = $relativePath;
            }
        }

        $stocks = json_decode($request->input('stocks'), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception('Dữ liệu stocks không hợp lệ');
        }

        foreach ($stocks as $stock) {
            if (!isset($stock['colorId']) || !isset($stock['sizeId']) || !isset($stock['quantity'])) {
                throw new \Exception('Dữ liệu stocks không đầy đủ');
            }
            if (!\App\Models\Color::find($stock['colorId'])) {
                throw new \Exception('Color ID không hợp lệ');
            }
            if (!\App\Models\Size::find($stock['sizeId'])) {
                throw new \Exception('Size ID không hợp lệ');
            }
            if (!is_numeric($stock['quantity']) || $stock['quantity'] < 1) {
                throw new \Exception('Số lượng không hợp lệ');
            }
        }

        $productData = [
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'hot' => $request->input('hot'),
            'sale' => $request->input('sale'),
            'description' => $request->input('description'),
            'brandId' => $request->input('brandId'),
            'categoryId' => $request->input('categoryId'),
        ];

        $product = $this->productRepository->createProduct($productData, $imageLinks, $stocks);

        return $product;
    }

    public function updateProduct($id, Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'hot' => 'required|boolean',
            'sale' => 'required|boolean',
            'description' => 'nullable|string',
            'brandId' => 'required|exists:brands,id',
            'categoryId' => 'required|exists:categories,id',
        ]);

        return $this->productRepository->updateProduct($id, $validated);
    }

    public function deleteProduct($id)
    {
        return $this->productRepository->deleteProduct($id);
    }
}