@extends('partials.app-master')
@section('content')
    <div class="login-form">
        <img src="{{asset('images/user1.png')}}" alt="">
        <h2>Register</h2>
        <form method="post" action="{{route('register.perform')}}">
            @csrf
            @include('partials.messages')
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="name@example.com" required="required" autofocus>
                {{-- @if ($errors->has('email'))
                    <span class="errormessage">{{ $errors->first('email') }}</span>
                @endif --}}
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required="required" autofocus>
                {{-- @if ($errors->has('username'))
                    <span class="errormessage">{{ $errors->first('username') }}</span>
                @endif --}}
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
                {{-- @if ($errors->has('password'))
                    <span class="errormessage">{{ $errors->first('password') }}</span>
                @endif --}}
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" required="required">
                {{-- @if ($errors->has('password_confirmation'))
                    <span class="errormessage">{{ $errors->first('password_confirmation') }}</span>
                @endif --}}
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
@endpush