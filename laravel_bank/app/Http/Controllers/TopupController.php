<?php

namespace App\Http\Controllers;

use App\Repositories\TopupRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class TopupController extends Controller
{
    protected $topupRepository;
    protected $userRepository;

    public function __construct(TopupRepository $topupRepository, UserRepository $userRepository)
    {
        $this->topupRepository = $topupRepository;
        $this->userRepository = $userRepository;
    }

    public function index(){
        $balance = $this->userRepository->currentBalance(auth()->user());
        return view('topup', compact('balance'));
    }

    public function store(Request $request){
        $this->validate($request, [
            'amount' => 'required|numeric'
        ]);
        try{
            $this->topupRepository->addTopup(auth()->user(), $request->amount);

        }catch (\Exception $e){
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->back()->with(['success' => __("Success Topup")]);
    }
}
