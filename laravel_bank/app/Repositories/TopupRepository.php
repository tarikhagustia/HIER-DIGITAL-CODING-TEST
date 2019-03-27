<?php
/**
 * Created by PhpStorm.
 * User: tarikhagustua
 * Date: 3/27/2019
 * Time: 7:35 PM
 */

namespace App\Repositories;

use App\Models\Mutation;
use App\Models\Topup;
use App\User;
use Carbon\Carbon;

class TopupRepository
{
    protected $topup;
    protected $userRepository;

    public function __construct(Topup $topup, UserRepository $userRepository)
    {
        $this->topup = $topup;
        $this->userRepository = $userRepository;
    }

    public function addTopup(User $user, $amount): Topup
    {
        // Add Transaction Log
        $topup = new Topup;
        $topup->user_id = $user->id;
        $topup->date = Carbon::now();
        $topup->amount = $amount;
        $topup->is_approved = true;
        $topup->save();

        $this->userRepository->addBalance($user, $amount);

        // Add to mutation
        $mut = new Mutation;
        $mut->user_id = $user->id;
        $mut->amount = $amount;
        $mut->type = 'C';
        $mut->reff_id = $topup->id;
        $mut->save();

        return $topup;
    }
}