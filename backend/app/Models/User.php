<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject; // Thêm interface này

class User extends Model implements JWTSubject // Implement interface
{
    protected $table = 'users';
    protected $fillable = ['email', 'password', 'role'];

    public function carts()
    {
        return $this->hasMany(Cart::class, 'userId');
    }

    // Triển khai phương thức getJWTIdentifier
    public function getJWTIdentifier()
    {
        return $this->getKey(); // Trả về khóa chính (thường là id)
    }

    // Triển khai phương thức getJWTCustomClaims
    public function getJWTCustomClaims()
    {
        return [
            'role' => $this->role,
            'email' => $this->email,
        ];
    }   
}