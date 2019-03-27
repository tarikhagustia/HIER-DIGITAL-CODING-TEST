@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Mutation Report</div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Amount</th>
                                </thead>
                                <tbody>
                                @forelse($trxs as $trx)
                                    <tr>
                                        <td>{{$trx->created_at}}</td>
                                        <td>{{$trx->type}}</td>
                                        <td>{{$trx->amount}}</td>
                                    </tr>
                                @empty
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
