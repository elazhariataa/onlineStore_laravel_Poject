@extends('adminSpace.adminDashboard')
@section('content')
    <form action="{{route('addProduct')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('partials.messages')
        <div class="card card-warning">
            <div class="card-header">
              <h3 class="card-title">Add a Product</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form>
                <div class="row">
                  <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                      <label>Product Name</label>
                      <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter ...">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <label>Product Price</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text">$</span>
                        </div>
                        <input type="number" class="form-control" name="price" value="{{ old('price') }}">
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
                      <textarea class="form-control" name="description"  rows="3" placeholder="Enter ...">{{ old('description') }}</textarea>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <!-- radio -->
                    <div class="form-group">
                        <label>This Product for</label>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                        <label class="form-check-label">Male</label>
                        </div>
                        <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="female">
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
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Add product image</label>
                            <!-- <label for="customFile">Custom File</label> -->
                            <div class="custom-file">
                              <input type="file" class="custom-file-input" name="image" id="image">
                              <label class="custom-file-label" for="customFile">Choose file</label>
                              {{-- <input class="custom-file-label" disabled> --}}
                            </div>
                        </div>
                    </div>
                    
                </div>
                <button type="submit" class="btn btn-block btn-dark btn-sm">Add product</button>
    </form>
        
          

        
@endsection


