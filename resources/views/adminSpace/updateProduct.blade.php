@extends('adminSpace.adminDashboard')
@section('content')
    <form method="POST" action="{{route('editeProduct',$product)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('partials.messages')
        <div class="card card-warning">
            <div class="card-header">
              <h3 class="card-title">Update a Product</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              
                <div class="row">
                  <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Product Name</label>
                      <input type="text" class="form-control" name="name" value="{{$product->name}}" placeholder="Enter ...">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <label>Product Price</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">$</span>
                        </div>
                        <input type="number" class="form-control" name="price" value="{{$product->price}}">
                        <div class="input-group-append">
                          <span class="input-group-text">.00</span>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <!-- textarea -->
                    <div class="form-group">
                      <label>Product Description</label>
                      <textarea class="form-control" name="description"  rows="3" placeholder="Enter ...">{{$product->description}}</textarea>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <!-- radio -->
                    <div class="form-group">
                        <label>This Product for</label>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ $product->gender == 'male' ? 'checked' : '' }}>
                        <label class="form-check-label">Male</label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ $product->gender == 'female' ? 'checked' : '' }}>
                        <label class="form-check-label">Female</label>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                      <!-- select -->
                      <div class="form-group">
                        <label>choose Category</label>
                        <select class="form-control" name="category_id">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Change" product image</label>
                            <!-- <label for="customFile">Custom File</label> -->
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="image" id="image">
                              <label class="custom-file-label" for="customFile">{{$product->image}}</label>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <h4>Product Image</h4>
                    </div>
                    <div class="col-sm-6">
                        <img src="{{ Storage::url($product->image) }}" class="img-thumbnail mt-2" width="300" height="200">
                    </div>
                </div>
                <button type="submit" class="btn btn-block btn-dark btn-sm">Edite product</button>
    </form>
        
          

        
@endsection


