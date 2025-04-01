<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name', 'price', 'hot', 'sale', 'description', 'brandId', 'categoryId'];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brandId');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'productId');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'productId');
    }

    public function productStocks()
    {
        return $this->hasMany(ProductStock::class, 'productId');
    }
}