<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Thay đổi ở đây
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    protected $table = 'users';
    protected $fillable = ['email', 'password', 'role'];

    public function getJWTIdentifier()
    {
        return $this->getKey(); 
    }

    public function getJWTCustomClaims()
    {
        return [
            'role' => $this->role,
            'email' => $this->email,
        ];
    }
}