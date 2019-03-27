<?php
/**
 * Created by PhpStorm.
 * User: tarikhagustua
 * Date: 3/27/2019
 * Time: 7:48 PM
 */

namespace App\Repositories;

use App\User;

class UserRepository
{
    public function __construct(User $user)
    {
    }

    public function addBalance(User $user, $amount): User
    {
        $user->balance = ($user->balance + $amount);
        $user->save();

        return $user;
    }

    public function currentBalance(User $user): float
    {
        return $user->balance;
    }
}