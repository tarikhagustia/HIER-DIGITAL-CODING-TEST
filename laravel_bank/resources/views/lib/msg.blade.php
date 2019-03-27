@if ($success = Session::get('success'))
    <div class="alert alert-success" role="alert">
        <button class="close" data-dismiss="alert"></button>
        <strong>Success : </strong>{{$success}}
    </div>
@endif

@if ($error = Session::get('error'))
    <div class="alert alert-danger" role="alert">
        <button class="close" data-dismiss="alert"></button>
        <strong>Error : </strong>{{$error}}
    </div>
@endif
