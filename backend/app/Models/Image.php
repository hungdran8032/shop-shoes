<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable = ['link', 'productId'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'productId');
    }

    
}
