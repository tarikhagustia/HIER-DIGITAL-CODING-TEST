<?php

namespace App\Http\Controllers;

use App\Repositories\WithdrawalRepository;
use Illuminate\Http\Request;
use App\Repositories\TopupRepository;
use App\Repositories\UserRepository;

class WithdrawalController extends Controller
{
    protected $userRepository;
    protected $withdrawalRepository;

    public function __construct(WithdrawalRepository $withdrawalRepository, UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->withdrawalRepository = $withdrawalRepository;
    }

    public function index()
    {
        $balance = $this->userRepository->currentBalance(auth()->user());
        return view('withdrawal', compact('balance'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric'
        ]);
        try {
            $this->withdrawalRepository->addWithdrawal(auth()->user(), $request->amount);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->back()->with(['success' => __("Success Withdrawal")]);
    }
}
