@if ($errors->all())

    <div class="alert alert-danger">
        <button class="close" data-dismiss="alert"></button>
        @foreach ($errors->all() as $key => $value)
            <p>
                {{$value}}
            </p>
        @endforeach
    </div>
@endif
