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

    public function createProduct(Request $request)
    {   
        $imageLinks = [];
        if ($request->hasFile('images')) {
            try{
                foreach ($request->file('images') as $file) {
                    $path = $file->store('assets/uploads/demo', 'public');
                    $fileName = basename($path);
                    $relativePath = "uploads/demo/{$fileName}";
                    $imageLinks[] = $relativePath;
                }
            }catch(\Exception $e){
                \Log::info('có lỗi: ' . $e->getMessage());
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

        // Chuyển đổi hot và sale thành số (1 hoặc 0) để tránh lỗi khi chèn vào DB
        $productData = [
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'hot' => (int) filter_var($request->input('hot'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? 0,
            'sale' => (int) filter_var($request->input('sale'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? 0,
            'description' => $request->input('description'),
            'brandId' => $request->input('brandId'),
            'categoryId' => $request->input('categoryId'),
        ];

        \Log::info('Dữ liệu $productData trước khi tạo: ', $productData);

        $product = $this->productRepository->createProduct($productData, $imageLinks, $stocks);

        return $product;
    }
}