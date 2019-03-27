<?php

namespace App\Http\Controllers;

use App\Repositories\MutationRepository;
use Illuminate\Http\Request;

class MutationController extends Controller
{
    protected $mutationRepository;
    public function __construct(MutationRepository $mutationRepository)
    {
        $this->mutationRepository = $mutationRepository;
    }

    public function report()
    {
        $trxs = $this->mutationRepository->getPaginate();
        return view('report.mutation', compact('trxs'));
    }
}
