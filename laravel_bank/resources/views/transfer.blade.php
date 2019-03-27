@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Transfer</div>

                <div class="card-body">
                    <h3>Current Balance is {{number_format($balance)}}</h3>
                    @include('lib/validator')
                    @include('lib/msg')
                    <form class="" action="{{route('transfer')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Enter email : </label>
                            <input type="email" name="email" class="form-control" placeholder="Enter destinatio email">
                        </div>
                        <div class="form-group">
                            <label>Enter amount : </label>
                            <input type="number" name="amount" class="form-control" placeholder="Enter amount">
                            <br>
                        </div>
                        <button type="submit" class="btn btn-primary">Topup</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
