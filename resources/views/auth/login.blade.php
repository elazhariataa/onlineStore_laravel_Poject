@extends('partials.app-master')
@section('content')
    <div class="login-form">
        <img src="{{asset('images/user1.png')}}" alt="">
        <h2>Login</h2>
        <form method="post" action="{{route('login.perform')}}">
            @csrf
            @include('partials.messages')
            <div class="form-group">
                <label for="email">Email or Username</label>
                <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required="required" autofocus>
                {{-- @if ($errors->has('username'))
                    <span class="errormessage">{{ $errors->first('username') }}</span>
                @endif --}}
            </div class="form-group">
            <div>
                <label for="password">Password</label>
                <input type="password" class="form-control"  name="password" value="{{ old('password') }}" placeholder="Password" required="required">
                {{-- @if ($errors->has('password'))
                    <span class="errormessage">{{ $errors->first('password') }}</span>
                @endif --}}
            </div>
            
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
@endpush
