<?php
/**
 * Created by PhpStorm.
 * User: tarikhagustua
 * Date: 3/27/2019
 * Time: 7:35 PM
 */

namespace App\Repositories;

use App\Exceptions\InsufficientBalance;
use App\Models\Mutation;
use App\Models\Withdrawal;
use App\User;
use Carbon\Carbon;

class WithdrawalRepository
{
    protected $withdrawal;
    protected $userRepository;

    public function __construct(Withdrawal $withdrawal, UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function addWithdrawal(User $user, $amount): Withdrawal
    {
        // Check if balance is not enought
        if ($amount >= $user->balance) {
            throw new InsufficientBalance("Insufficient Balance");
        }
        // Add Transaction Log
        $wd = new Withdrawal;
        $wd->user_id = $user->id;
        $wd->date = Carbon::now();
        $wd->amount = $amount;
        $wd->is_approved = true;
        $wd->save();

        $this->userRepository->addBalance($user, -($amount));

        // Add to mutation
        $mut = new Mutation;
        $mut->user_id = $user->id;
        $mut->amount = $amount;
        $mut->type = 'D';
        $mut->reff_id = $wd->id;
        $mut->save();

        return $wd;
    }
}