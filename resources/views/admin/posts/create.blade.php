@extends('layouts.admin')

@section('content')
<h1>Create User</h1>
<div class="row">
    <form method="POST" action="/admin/posts" enctype="multipart/form-data" >
        @csrf
            <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="">
                    
            </div>
            <div class="form-group">
                    <label for="body">Body</label>
                    <textarea class="form-control" id="body" name="body" rows="3"></textarea>
                    
            </div>

            <div class="form-group">
                    <label for="category_id">Category select</label>
                    <select class="form-control" id="category_id" name="category_id">
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option> 
                    @endforeach
                    </select>
            </div>
                            
            <input type="hidden" name="user_id" value="{{$user->id}}">
            <div class="form-group">
                        <input type="file" class="form-control-file" name="file" id="exampleInputFile">
            </div>
            
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>
<div class="row">
        @include('includes.formerror')
</div>
@endsection