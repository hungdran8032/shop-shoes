<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colors';
    protected $fillable = ['name'];
    public $timestamps = false;

    public function productStocks()
    {
        return $this->hasMany(ProductStock::class, 'colorId');
    }
}