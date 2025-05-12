<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $fillable = [
        'userId', 
        'name', 
        'productId', 
        'brandId',  
        'price', 
        'size', 
        'color', 
        'quantity', 
        'isPayed'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'productId');
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class, "brandId");
    }

    public function order()
    {
        return $this->belongsTo(Order::class, "orderId");
    }
}