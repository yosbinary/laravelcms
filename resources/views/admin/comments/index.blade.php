@extends('layouts.admin')
@section('content')
<h1>Comments</h1>
@if (count($comments) > 0)
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Post</th>
        <th scope="col">email</th>
        <th scope="col">Body</th>
        <th scope="col">Control</th>
        <th scope="col">view post</th>
        <th scope="col">Created at</th>
        <th scope="col">Updated at</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($comments  as $comment)
        <tr>
        <th scope="row">{{$comment->id}}</th>
        <td>{{$comment->author}}</td>
        <td>{{$comment->post_id}}</td>
        <td>{{$comment->email}}</td>
        <td>{{$comment->body}}</td>
        <td>
        @if($comment->is_active == 0)
        <form action="{{route('admin.comments.update', $comment->id)}}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="is_active" value="1">
            <button class="btn btn-primary btn-sm">Approve</button>
        </form>
        @else
        <form action="{{route('admin.comments.update', $comment->id)}}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="is_active" value="0">
                <button class="btn btn-primary btn-sm">Un-Approve</button>
            </form>
        @endif
        
                <form action="{{route('admin.comments.destroy',$comment->id)}}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn btn-danger btn-sm">DELETE</button>
                </form>
         
         </td>
        <td><a href="{{route('home.post',$comment->post_id)}}">View Post</a><br><a href="{{route('admin.posts.edit',$comment->post_id)}}">Edit Post</a></td>
        <td>{{$comment->created_at}}</td>
        <td>{{$comment->updated_at}}</td>
        </tr>
              
        @endforeach
    

            
    </tbody>
  </table>
@else
    <H1>No Comment</H1>
@endif
@endsection