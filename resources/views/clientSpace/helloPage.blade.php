@extends('clientSpace.clientDashboard')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Welcome to Your Dashboard') }}</div>

                    <div class="card-body">
                        <p>Hello :{{auth()->user()->username}}, welcome to your dashboard!</p>
                        <p>{{ __('Here you can view your orders, manage your account settings, and more.') }}</p>
                        <p>{{ __('If you have any questions or need assistance, please feel free to contact us at any time.') }}</p>
                        <a href="{{route('orderList')}}" class="btn"><button type="button" class="btn btn-block btn-primary">View My Orders</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('css/hello.css') }}" rel="stylesheet">
@endpush