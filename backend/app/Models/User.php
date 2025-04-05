<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['email', 'password', 'role'];

    public function carts()
    {
        return $this->hasMany(Cart::class, 'userId');
    }
}