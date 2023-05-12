@extends('adminSpace.adminDashboard')
@section('content')
    <div class="categoryMain">
        <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Add a category</h3>
            </div>
            <div class="card-body">
              <form method="POST" action="{{route('category.add')}}">
                @csrf
                <input class="form-control form-control-lg" type="text" name="name" value="{{ old('name') }}" placeholder="Category name">
                <br>
                <button type="submit" class="btn btn-block btn-success btn-xs">Add</button>
              </form>
            </div>
        </div>
        {{-- category tables --}}
       
            
            <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Categories</h3>
      
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
                            <th>Category Name</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th>Actions</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                            @if (count($categories)>0)
                            @foreach ($categories as $category)
                            <tr>
                              <td>{{$category->id}}</td>
                              <td>{{$category->name}}</td>
                              <td>{{$category->created_at}}</td>
                              <td>{{$category->updated_at}}</td>
                              {{-- <td><button type="button" class="btn btn-block btn-danger">Delete</button> / <button type="button" class="btn btn-block btn-primary">Edite</button></td> --}}
                              <td>
                                <form action="{{ route('deleteCategory', $category)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-block btn-danger btn-xs">Delete</button><br>
                                </form>
                                <a href="{{route('updatedCategory',$category)}}"><button type="button" class="btn btn-block btn-primary btn-xs">Edite</button></a>
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
            
        
    </div>
@endsection

