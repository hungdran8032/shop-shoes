<?php
namespace App\Repositories;

use App\Models\Product;
use App\Models\Image;
use App\Models\ProductStock;
use Illuminate\Support\Facades\DB;

class ProductRepository
{
    public function getAllProducts()
    {
        return Product::with(['brand', 'category', 'images', 'stocks.color', 'stocks.size'])->get();
    }

    public function getProductById($id)
    {
        return Product::with(['brand', 'category', 'images', 'stocks.color', 'stocks.size'])->find($id);
    }

    public function createProduct(array $data, array $imageLinks, array $stocks)
    {
        DB::beginTransaction();
        try {
            $product = Product::create($data);

            foreach ($imageLinks as $link) {
                Image::create([
                    'product_id' => $product->id,
                    'link' => $link
                ]);
            }

            if ($stocks) {
                foreach ($stocks as $stock) {
                    ProductStock::create([
                        'product_id' => $product->id,
                        'color_id' => $stock['color_id'],
                        'size_id' => $stock['size_id'],
                        'quantity' => $stock['quantity'],
                    ]);
                }
            }

            DB::commit();
            return $product;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateProduct($id, array $data)
    {
        $product = Product::find($id);
        if ($product) {
            $product->update($data);
        }
        return $product;
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
        }
        return $product;
    }
}
?>