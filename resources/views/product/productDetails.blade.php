@extends('partials.app-master')
@section('content')
<div class="main">
    <div class="card">
        <div class="card__title">
          <div class="icon">
            <a href="#"><i class="fa fa-arrow-left"></i></a>
          </div>
          <h3>New products</h3>
        </div>
        <div class="card__body">
          <div class="half">
            <div class="featured_text">
              <h1>{{$product->name}}</h1>
              <p class="sub">Original product</p>
              <p class="price">${{$product->price}}</p>
            </div>
            <div class="image">
              <img src="{{Storage::url($product->image)}}" alt="">
            </div>
          </div>
          <div class="half">
            <div class="description">
              <p>{{$product->description}}</p>
              <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quasi consequatur, impedit optio laboriosam eligendi nesciunt quod omnis, eum accusantium, assumenda libero praesentium aspernatur. Libero neque cumque ab omnis eius at!</p>
            </div>
            <span class="stock"><i class="fa fa-pen"></i> In stock</span>
          </div>
        </div>
        <div class="card__footer">
          <div class="recommend">
            <p>Recommended by</p>
            <h3>Andrew Palmer</h3>
          </div>
          <div class="action">
            <form method="POST" action="{{route('addToCart',$product->id)}}">
              @csrf
              <button type="submit">Add to cart</button>
            </form>
            
          </div>
        </div>
      </div>
</div>

@endsection

@push('styles')
    <link href="{{ asset('css/productDetails.css') }}" rel="stylesheet">
@endpush

