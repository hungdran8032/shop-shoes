<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Brand;

class CartApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_cart()
    {
        $product = Product::factory()->create();
        $brand = Brand::factory()->create();
        $user = User::factory()->create();

        $payload = [
            'name' => 'Test Cart',
            'price' => 200000,
            'size' => 'M',
            'color' => 'Red',
            'quantity' => 1,
            'isPayed' => false,
            'productId' => $product->id,
            'brandId' => $brand->id,
            'userId' => $user->id,
            'orderId' => null
        ];

        $response = $this->postJson('/api/carts', $payload);
        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Test Cart']);
    }
}
