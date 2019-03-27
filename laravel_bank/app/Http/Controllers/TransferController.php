<?php

namespace App\Http\Controllers;

use App\Repositories\TransferRepository;
use Illuminate\Http\Request;
use App\Repositories\TopupRepository;
use App\Repositories\UserRepository;

class TransferController extends Controller
{
    protected $transferRepository;
    protected $userRepository;

    public function __construct(TransferRepository $transferRepository, UserRepository $userRepository)
    {
        $this->transferRepository = $transferRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $balance = $this->userRepository->currentBalance(auth()->user());
        return view('transfer', compact('balance'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric',
            'email' => 'exists:users,email'
        ]);

        try{
            $this->transferRepository->makeTransfer(auth()->user(), $request->post('email'), $request->post('amount'));
        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->back()->with(['success' => __("Success Transfer to {$request->email} amounted {$request->amount}")]);
    }
}
