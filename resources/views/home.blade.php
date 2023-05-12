@extends('partials.app-master')
@section('content')
    <div>
        <div name="filterForm">
            <fieldset>
                <legend>Filter products</legend>
                <form method="GET" action="{{route('home')}}">
                    <div class="form-g">
                        <label for="name">Product Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Search by product name...">
                    </div>
                    <div >
                        <label for="price">Product Price</label>
                        <input type="number" class="form-control" name="price" id="price" placeholder="Search by product price...">
                    </div>
                    <div class="form-g">
                        <label for="category_id">Filter by Category</label>
                        <select class="form-control" name="category_id" id="category_id">
                            <option value="">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-g">
                        <label for="gender">Filter by Gender</label>
                        <select class="form-control" name="gender" id="gender">
                            <option value="">Bouth</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </fieldset>
        </div>
        
        
    </div>
    <div class="cards">
        @foreach ($products as $product)
            <div class="card">
                <div class="imgBox">
                <img src="{{Storage::url($product->image)}}" alt="mouse corsair" class="mouse">
                </div>
            
                <div class="contentBox">
                <h3>{{$product->name}}</h3>
                <h2 class="price">{{$product->price}} €</h2>
                <a href="{{route('productDetails',$product)}}" class="buy">See Details</a>
                <form method="POST" action="{{route('addToCart',$product->id)}}">
                    @csrf
                    {{-- <a href="" class="buy">Add to card</a> --}}
                    <button type="submit" class="buy">Add to cart</button>
                </form>
                    
                </div>
            </div>
        @endforeach
    </div>
@endsection

@push('styles')
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endpush