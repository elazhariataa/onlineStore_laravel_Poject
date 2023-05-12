@if(isset ($errors) && count($errors) > 0)
    <div class="alert alert-warning" role="alert">
        <ul>
            @foreach($errors->all() as $error)
                <li class="errormessage">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(Session::get('success', false))
    <?php $data = Session::get('success'); ?>
    @if (is_array($data))
        @foreach ($data as $msg)
            <div role="alert">
                <i>{{ $msg }}</i>
            </div>
        @endforeach
    @else
        <div role="alert">
            <i>{{ $data }}</i>
        </div>
    @endif
@endif