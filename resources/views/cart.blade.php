@extends('partials.app-master')
@section('content')
<div class="shopping-cart">
    <!-- Title -->
    <div class="title">
      Shopping Cart
    </div>
    
    @if (count($cartItems) > 0)
        @foreach ( $cartItems as $item)
            <div class="item">
                <div class="buttons">
                    <form method="POST" action="{{route('deleteCartItem',$item['product']->id)}}">
                        @csrf
                        @method('DELETE')
                        <button class="delete-btn">X</button>
                    </form>
                </div>
            
                <div class="image">
                <img src="{{Storage::url($item['product']->image)}}" alt="" />
                </div>
            
                <div class="description">
                <p>{{ $item['product']->name }}</p>
                
                </div>
            
                <div class="quantity">
                    <form method="POST" action="{{route('decreaseQuantity',$item['product']->id)}}">
                        @csrf
                        <button class="minus-btn" type="submit" name="button">
                            -
                        </button>
                    </form>
               
                    <span class="quantityValue">{{ $item['quantity'] }}</span>

                    <form method="POST" action="{{route('increaseQuantity',$item['product']->id)}}">
                        @csrf
                        <button class="plus-btn" type="submit" name="button">
                            +
                        </button>
                    </form>
                </div>
            
                <div class="total-price">${{ $item['quantity'] * $item['product']->price }}</div>
            </div>
        @endforeach

        <div class="checkout">
            <div class="total">
                <div>
                    <div class="Subtotal">Sub-Total</div>
                    <div class="items">{{count($cartItems)}} Items</div>
                </div>
                <div class="total-amount">${{ $total }}</div>
            </div>
            <form method="POST" action="{{route('addOrder')}}">
                @csrf
                <button class="button" type="submit">Checkout</button>
            </form>
        </div>
       
    @else
        <p>Your cart is empty.</p>
    @endif
    
   
  </div>
@endsection
@push('styles')
    <link href="{{ asset('css/cart.css') }}" rel="stylesheet">
@endpush
