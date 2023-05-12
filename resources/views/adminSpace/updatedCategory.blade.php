@extends('adminSpace.adminDashboard')
@section('content')
<div class="categoryMain">
    <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">Update a category</h3>
        </div>
        <div class="card-body">
          <form method="POST" action="{{route('EditeCategory',$category)}}">
            @method('PUT') 
            @csrf
            <input class="form-control form-control-lg" type="text" name="name" value="{{$category->name}}" placeholder="Category name">
            <br>
            <button type="submit" class="btn btn-block btn-success btn-xs">Update</button>
          </form>
        </div>
    </div>
@endsection