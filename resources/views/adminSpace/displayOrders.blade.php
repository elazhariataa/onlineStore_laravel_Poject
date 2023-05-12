@extends('adminSpace.adminDashboard')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Orders List</h3>

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
                <th>Order owner</th>
                <th>Order State</th>
                <th>Created at</th>
                <th>change order Satate</th>
              </tr>
            </thead>
            <tbody>
                @if (count($orders)>0)
                    @foreach ($orders as $order)
                        <form method="POST" action="{{route('changeOrderState',$order->id)}}">
                            @csrf
                            @method('PATCH')
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->user->username}}</td>
                                <td>
                                    <select class="form-control" name="state">
                                        <option value="Pending" {{ $order->state == 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Processing" {{ $order->state == 'Processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="Shipped" {{ $order->state == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="Delivered" {{ $order->state == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="Cancelled" {{ $order->state == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </td>
                                <td>{{$order->created_at}}</td>
                                <td>
                                    <button type="submit" class="btn btn-block btn-primary btn-xs">Save changes</button>
                                </td>
                            </tr>
                        </form>
                        
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