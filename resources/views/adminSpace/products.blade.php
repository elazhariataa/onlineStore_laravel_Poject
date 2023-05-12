@extends('adminSpace.adminDashboard')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Products</h3>

          <div class="card-tools">
            <div>
              <form method="POST" action="{{ route('product.import') }}"  enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="form-control">
                <br>
                <button class="btn btn-success" type="submit">Import Product Data</button>
              </form>
            </div>
            <a class="btn btn-warning float-end" href="{{ route('product.export') }}">Export Product Data</a>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 300px;">
          <table class="table table-head-fixed text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>This product for</th>
                <th>Description</th>
                <th>Price</th>
                <th>Category ID</th>
                <th>Product Image</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Actions</th>
                
              </tr>
            </thead>
            <tbody>
                @if (count($products)>0)
                @foreach ($products as $product)
                <tr>
                  <td>{{$product->id}}</td>
                  <td>{{$product->name}}</td>
                  <td>{{$product->gender}}</td>
                  <td>{{$product->description}}</td>
                  <td>{{$product->price}}</td>
                  <td>{{$product->category->name}}</td>
                  <td><img src="{{ Storage::url($product->image)}}" alt="Product image" width="100" height="100"></td>
                  <td>{{$product->created_at}}</td>
                  <td>{{$product->updated_at}}</td>
                  <td>
                    <form action="{{route('deleteProduct',$product)}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-block btn-danger btn-xs" onclick="return confirm('{{ __('Delete this product?') }}')">Delete</button><br>
                    </form>
                    
                    <a href="{{route('updateProduct',$product)}}"><button type="button" class="btn btn-block btn-primary btn-xs">Edite</button></a>
                  </td>
                </tr>
              @endforeach
                @endif
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </div>
@endsection