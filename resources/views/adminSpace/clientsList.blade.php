@extends('adminSpace.adminDashboard')
@section('content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Products</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

              <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
            {{-- <a class="btn btn-warning float-end" href="{{ route('productsExport') }}">Export Products Data</a> --}}
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 300px;">
          <table class="table table-head-fixed text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>client Name</th>
                <th>Client Email</th>
                <th>Account State</th>
                <th>created At</th>
                <th>updated At</th>
                <th>Actions</th>
                
              </tr>
            </thead>
            <tbody>
                @if (count($clients)>0)
                @foreach ($clients as $client)
                <tr>
                  <td>{{$client->id}}</td>
                  <td>{{$client->username}}</td>
                  <td>{{$client->email}}</td>
                  <td>{{$client->is_blocked? "Blocked" : "Active"}}</td>
                  <td>{{$client->created_at}}</td>
                  <td>{{$client->updated_at}}</td>
                  <td>
                    <form method="POST" action="{{route('deleteClient',$client)}}">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-block btn-danger btn-xs" onclick="return confirm('{{ __('Delete this Client?') }}')">Delete</button><br>
                    </form>
                    
                    <form method="POST" action="{{route('changeAccountState',$client->id)}}">
                        @csrf
                        @method("PATCH")
                        <button type="submit" class="btn btn-block btn-primary btn-xs">{{$client->is_blocked? "Unblock" : "Block"}}</button>
                    </form>
                    
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


