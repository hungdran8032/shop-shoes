<?php
namespace App\Services;

use App\Repositories\ImageRepository;
use App\Repositories\ProductRepository;
use App\Repositories\StockRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;

class ProductService
{
    protected $productRepository;
    protected $imageRepository;
    protected $stockRepository;

    public function __construct(ProductRepository $productRepository, ImageRepository $imageRepository, StockRepository $stockRepository)
    {
        $this->productRepository = $productRepository;
        $this->imageRepository = $imageRepository;
        $this->stockRepository = $stockRepository;
    }

    public function getById($id)
    {
        return $this->productRepository->getById($id);
    }

    public function getAll()
    {
        return $this->productRepository->getAllProducts();
    }

    public function createProduct(Request $request)
    {
        // Chuẩn bị dữ liệu sản phẩm
        $productData = [
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'hot' => (int) filter_var($request->input('hot'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? 0,
            'sale' => (int) filter_var($request->input('sale'), FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? 0,
            'description' => $request->input('description'),
            'brandId' => $request->input('brandId'),
            'categoryId' => $request->input('categoryId'),
        ];

        try {
            // Tạo sản phẩm
            $product = $this->productRepository->createProduct($productData);

            // Xử lý upload ảnh
            // Xử lý nhiều hình ảnh
            if ($request->hasFile('images')) {
                $imageFiles = $request->file('images');
                // Ensure $imageFiles is an array (even if a single file is uploaded)
                $imageFiles = is_array($imageFiles) ? $imageFiles : [$imageFiles];
                foreach ($imageFiles as $file) {
                    if ($file->isValid()) {
                        $path = $file->store('assets/uploads/demo', 'public');
                        $fileName = basename($path);
                        $imageData = [
                            'productId' => $product->id,
                            'link' => "uploads/demo/{$fileName}",
                        ];
                        $this->imageRepository->create($imageData);
                    }
                }
            }

            // Xử lý stocks
            $stocks = json_decode($request->input('stocks'), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Dữ liệu stocks không hợp lệ');
            }

            foreach ($stocks as $stock) {
                // Kiểm tra dữ liệu đầu vào
                if (!isset($stock['colorId']) || !isset($stock['sizeId']) || !isset($stock['quantity'])) {
                    throw new \Exception('Dữ liệu stocks không đầy đủ');
                }

                // Validate color và size
                if (!\App\Models\Color::find($stock['colorId'])) {
                    throw new \Exception('Color ID không hợp lệ');
                }
                if (!\App\Models\Size::find($stock['sizeId'])) {
                    throw new \Exception('Size ID không hợp lệ');
                }
                if (!is_numeric($stock['quantity']) || $stock['quantity'] < 0) { // Sửa < 1 thành < 0 nếu muốn cho phép quantity = 0
                    throw new \Exception('Số lượng không hợp lệ');
                }

                // Tạo stock (giả sử bạn có stockRepository)
                $this->stockRepository->create([
                    'productId' => $product->id,
                    'colorId' => $stock['colorId'],
                    'sizeId' => $stock['sizeId'],
                    'quantity' => (int) $stock['quantity'],
                ]);
            }

            return $product;

        } catch (\Exception $e) {
            \Log::error('Lỗi khi tạo sản phẩm: ' . $e->getMessage());
            throw $e; // Ném lại exception để controller xử lý
        }
    }
}