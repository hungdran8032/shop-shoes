<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $fillable = ['name', 'price', 'size', 'color', 'quantity', 'isPayed', 'productId', 'brandId', 'userId', 'orderId'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'productId');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brandId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'orderId');
    }
}