<?php
/**
 * Created by PhpStorm.
 * User: tarikhagustua
 * Date: 3/27/2019
 * Time: 8:16 PM
 */

namespace App\Repositories;

use App\Models\Transfer;
use App\User;
use Carbon\Carbon;
use App\Models\Mutation;

class TransferRepository
{
    protected $model;
    protected $userRepository;

    public function __construct(Transfer $transfer, UserRepository $userRepository)
    {
        $this->model = $transfer;
        $this->userRepository = $userRepository;
    }

    public function makeTransfer(User $from, string $email_destination, $amount)
    {
        // Find User
        try {
            $destination = User::where('email', $email_destination)->first();
        } catch (\Exception $e) {
            throw new \Exception("User destination not found ($email_destination)");
        }
        $trf = new Transfer;
        $trf->from_user_id = $from->id;
        $trf->to_user_id = $destination->id;
        $trf->date = Carbon::now();
        $trf->amount = $amount;
        $trf->is_approved = true;
        $trf->save();

        // Add to mutation user
        $mut = new Mutation;
        $mut->user_id = $from->id;
        $mut->amount = $amount;
        $mut->type = 'D';
        $mut->reff_id = $trf->id;
        $mut->save();
        $this->userRepository->addBalance($from, -($amount));

        // Add to mutation received user
        $mut = new Mutation;
        $mut->user_id = $destination->id;
        $mut->amount = $amount;
        $mut->type = 'C';
        $mut->reff_id = $trf->id;
        $mut->save();
        $this->userRepository->addBalance($destination, $amount);

        // Add Balance

        return $trf;

    }
}
