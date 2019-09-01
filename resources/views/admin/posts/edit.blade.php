@extends('layouts.admin')

@section('content')
<h1>Edit Post</h1>

<div class="row">
<div class="col-sm-6"><img src="{{$post->photo->file}}" class="img-responsive"></div>
        <div class="col-sm-6">
                <form method="POST" action="{{route('admin.posts.update',$post->id)}}" enctype="multipart/form-data" >
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                                <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title" value="{{$post->title}}">
                                
                        </div>
                        <div class="form-group">
                                <label for="body">Body</label>
                        <textarea class="form-control" id="body" name="body" rows="3" >{{$post->body}}</textarea>
                                
                        </div>

                        <div class="form-group">
                                <label for="category_id">Category select</label>
                                <select class="form-control" id="category_id" name="category_id">
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}" {{$category->id == $post->category_id? 'selected': ''}}>{{$category->name}}</option> 
                                @endforeach
                                </select>
                        </div>
                                        
                        
                        <div class="form-group">
                                        <input type="file" class="form-control-file" name="file" id="exampleInputFile">
                        </div>
                        
                        <button type="submit" class="btn btn-primary col-sm-6" name="submit">Submit</button>
                </form>
                <form action="{{route('admin.posts.destroy',$post->id)}}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger col-sm-6" name="submit">DELETE</button>

                </form>
                <div class="row" style="margin-top: 20px">
                                @include('includes.formerror')
                </div>
        </div>
        
</div>
@endsection