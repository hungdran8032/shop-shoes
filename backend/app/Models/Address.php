<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';
    protected $fillable = ['city', 'country', 'state', 'zipcode'];

    public function orders()
    {
        return $this->hasMany(Order::class, 'addressId');
    }
}