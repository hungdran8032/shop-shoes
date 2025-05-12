<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['name', 'email', 'phone', 'totalPrice', 'addressId'];

    public function address()
    {
        return $this->belongsTo(Address::class, 'addressId');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class, 'orderId');
    }
}