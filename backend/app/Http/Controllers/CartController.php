<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Log;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function createCartItem(Request $request)
    {
        try {
            \Log::info("Dữ liệu request thêm giỏ hàng:", $request->all());

            $userId = $request->userId;

            if (!$userId) {
                return response()->json(['message' => 'Vui lòng đăng nhập để thêm vào giỏ hàng.'], 401);
            }

            $product = Product::find($request->product_id);

            if (!$product) {
                return response()->json(['message' => 'Sản phẩm không tồn tại.'], 404);
            }

            $cartItem = Cart::where('userId', $userId)
                ->where('productId', $request->product_id)
                ->where('size', $request->size)
                ->where('color', $request->color)
                ->where('isPayed', false)
                ->first();

            if ($cartItem) {
                $cartItem->quantity += $request->quantity;
                $cartItem->save();
            } else {
                $cartItem = Cart::create([
                    'userId' => $userId,
                    'productId' => $request->product_id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'size' => $request->size,
                    'color' => $request->color,
                    'quantity' => $request->quantity,
                    'brandId' => $request->input('brand.id'),
                    'isPayed' => false,
                ]);
            }

            return response()->json([
                'message' => 'Cart item added successfully!',
                'cartItem' => $cartItem
            ], 201);
        } catch (\Exception $e) {
            \Log::error("Lỗi thêm vào giỏ hàng: " . $e->getMessage());

            return response()->json([
                'message' => 'Failed to add cart item'
            ], 500);
        }
    }

    public function getCartItems()
    {
        try {
            $cartItems = Cart::with([
                'product.images',
                'brand',
                'order'
            ])->get();

            $formattedCartItems = $cartItems->map(function ($item) {
                return [
                    'id' => $item->id,
                    'product_id' => $item->product->id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'brand' => [
                        'id' => $item->brand->id,
                        'name' => $item->brand->name
                    ],
                    'size' => $item->size,
                    'quantity' => $item->quantity,
                    'color' => $item->color,
                    'isPayed' => $item->isPayed,
                    'images' => $item->product->images
                ];
            });

            return response()->json($formattedCartItems, 200);
        } catch (\Exception $e) {
            \Log::error("Lỗi lấy giỏ hàng: " . $e->getMessage());
            return response()->json(['message' => 'Failed to retrieve cart items'], 500);
        }
    }

    public function getCartItemById($id)
    {
        try {
            $cartItem = Cart::with([
                'product.images',
                'brand',
                'order'
            ])->find($id);

            if (!$cartItem) {
                return response()->json(['message' => 'Cart item not found'], 404);
            }

            $formattedCartItem = [
                'product_id' => $cartItem->product->id,
                'name' => $cartItem->name,
                'price' => $cartItem->price,
                'brand' => [
                    'id' => $cartItem->brand->id,
                    'name' => $cartItem->brand->name
                ],
                'size' => $cartItem->size,
                'quantity' => $cartItem->quantity,
                'color' => $cartItem->color,
                'isPayed' => $cartItem->isPayed,
                'images' => $cartItem->product->images
            ];

            return response()->json($formattedCartItem, 200);
        } catch (\Exception $e) {
            \Log::error("Lỗi lấy mục giỏ hàng: " . $e->getMessage());
            return response()->json(['message' => 'Failed to retrieve cart item'], 500);
        }
    }

    public function getCartByUserId($userId)
    {
        try {
            $cartItems = Cart::where('userId', $userId)->with([
                'product.images',
                'brand',
                'order'
            ])->get();

            if ($cartItems->isEmpty()) {
                return response()->json(['message' => 'Giỏ hàng trống'], 404);
            }

            $formattedCartItems = $cartItems->map(function ($item) {
                return [
                    'id' => $item->id,
                    'product_id' => $item->product->id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'brand' => [
                        'id' => $item->brand->id,
                        'name' => $item->brand->name
                    ],
                    'size' => $item->size,
                    'quantity' => $item->quantity,
                    'color' => $item->color,
                    'isPayed' => $item->isPayed,
                    'images' => $item->product->images
                ];
            });

            return response()->json($formattedCartItems, 200);
        } catch (\Exception $e) {
            \Log::error("Lỗi lấy giỏ hàng theo user_id: " . $e->getMessage());
            return response()->json(['message' => 'Không thể lấy giỏ hàng'], 500);
        }
    }

    public function deleteCartItem($id)
    {
        try {
            $cartItem = Cart::find($id);

            if (!$cartItem) {
                return response()->json(['message' => 'Cart item not found'], 404);
            }

            $cartItem->delete();

            return response()->json(['message' => 'Cart item deleted successfully!'], 200);
        } catch (\Exception $e) {
            \Log::error("Lỗi xóa mục giỏ hàng: " . $e->getMessage());
            return response()->json(['message' => 'Failed to delete cart item'], 500);
        }
    }



}
