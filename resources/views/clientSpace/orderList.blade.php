@extends('clientSpace.clientDashboard')
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
                <th>Order details</th>
              </tr>
            </thead>
            <tbody>
                @if (count($orders)>0)
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{auth()->user()->username}}</td>
                            <td>{{$order->state}}</td>
                            <td>{{$order->created_at}}</td>
                            <td>
                                <a href="{{route('orderDetails',$order)}}"><button type="button" class="btn btn-block btn-primary btn-xs">See Details</button></a><br>
                                <a href="{{route('generatePDF',$order->id)}}"><button type="button" class="btn btn-block btn-warning btn-xs">Get Invoice</button></a>
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