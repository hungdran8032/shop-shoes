<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'sizes';
    protected $fillable = ['name'];
    public $timestamps = false;

    public function productStocks()
    {
        return $this->hasMany(ProductStock::class, 'sizeId');
    }
}