<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function createUser($data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => $data['password'] ?? null,
            'role' => 'user'
        ]);
    }

    public function updateRole(User $user, $role)
    {
        $user->role = $role;
        $user->save();
        return $user;
    }
}