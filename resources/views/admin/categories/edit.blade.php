@extends('layouts.admin')

@section('content')
<h1>Edit Category</h1>
<div class="row">
<form method="POST" action="{{route('admin.categories.update',$category->id)}}" enctype="multipart/form-data" >
        @csrf
            <div class="form-group">
                    <label for="title">name</label>
            <input type="hidden" name="_method" value="PUT">
            <input type="text" name="name" class="form-control" id="name" value="{{$category->name}}">
                    
            </div>
           
            
            <button type="submit" class="btn btn-primary col-sm-6" name="submit">Submit</button>
    </form>
<form action="{{route('admin.categories.destroy',$category->id)}}" method="POST">
@csrf
    <input type="hidden" name="_method" value="DELETE">
<button class="btn btn-danger col-sm-6">DELETE</button>
</form>
</div>
<div class="row" style="margin-top: 20px">
        @include('includes.formerror')
</div>
@endsection