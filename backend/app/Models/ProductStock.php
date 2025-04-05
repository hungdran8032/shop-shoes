<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    protected $table = 'product_stock';
    protected $fillable = ['productId', 'sizeId', 'colorId', 'quantity'];
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class, 'productId');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'sizeId');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'colorId');
    }
}