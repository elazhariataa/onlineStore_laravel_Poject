@extends('clientSpace.clientDashboard')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Orders Details</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 300px;">
          <table class="table table-head-fixed text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Product name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Created at</th>
                <th>Product details</th>
              </tr>
            </thead>
            <tbody>
                @if (count($orderItems)>0)
                    @foreach ($orderItems as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->product->name}}</td>
                            <td>{{$item->quantity}}</td>
                            <td>{{$item->price}}</td>
                            <td>{{$item->created_at}}</td>
                            <td>
                                <a href="{{route('productDetails',$item)}}"><button type="button" class="btn btn-block btn-primary btn-xs">See Product Details</button></a>
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