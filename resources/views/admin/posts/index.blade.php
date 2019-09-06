@extends('layouts.admin')

@section('content')

  @if(Session::has('alert_message'))
    <div class="alert alert-success">{{Session::get('alert_message')}}</div>
  @endif
    <h1>Posts</h1>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Photo</th>
            <th scope="col">User ID</th>
            <th scope="col">Category ID</th>
            <th scope="col">Title</th>
            <th scope="col">Body</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
            <th scope="row">{{$post->id}}</th>
            <td><img src="{{$post->photo? $post->photo->file : 'http://placehold.it/400x400'}}" style="width:200px;max-height:200px"></td>
            <td>{{$post->user->name}}</td>
            <td>{{$post->category ? $post->category->name : 'Uncatogerized'}}</td>
            <td>{{$post->photo_id}}</td>
            <td><a href="{{route('admin.posts.edit',$post->id)}}">{{$post->title}}</a></td>
            <td>{{$post->body}}</td>
            <td><a href="{{route('admin.comments.show',$post->id)}}">View Comments</a><br><a href="{{route('home.post',$post->id)}}">View Post</a></td>
            <td>{{$post->created_at->diffForHumans()}}</td>
            <td>{{$post->updated_at->diffForHumans()}}</td>
            </tr>      
            @endforeach
          
         
        </tbody>
      </table>
    
@endsection