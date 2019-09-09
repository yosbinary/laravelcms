@extends('layouts.admin')
@section('content')
<h1>replies</h1>
@if (count($replies) > 0)
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Comment id</th>
        <th scope="col">email</th>
        <th scope="col">Body</th>
        <th scope="col">Control</th>
        <th scope="col">view post</th>
        <th scope="col">Created at</th>
        <th scope="col">Updated at</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($replies  as $reply)
        <tr>
        <th scope="row">{{$reply->id}}</th>
        <td>{{$reply->author}}</td>
        <td>{{$reply->comment_id}}</td>
        <td>{{$reply->email}}</td>
        <td>{{$reply->body}}</td>
        <td>
        @if($reply->is_active == 0)
        <form action="{{route('admin.replies.update', $reply->id)}}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="comment_id" value="{{$reply->comment_id}}">
            <input type="hidden" name="is_active" value="1">
            <button class="btn btn-primary btn-sm">Approve</button>
        </form>
        @else
        <form action="{{route('admin.replies.update', $reply->id)}}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="comment_id" value="{{$reply->comment_id}}">
                <input type="hidden" name="is_active" value="0">
                <button class="btn btn-primary btn-sm">Un-Approve</button>
            </form>
        @endif
        
                <form action="{{route('admin.replies.destroy',$reply->id)}}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="DELETE">
                <button class="btn btn-danger btn-sm">DELETE</button>
                </form>
         
         </td>
        <td><a href="{{route('home.post',$reply->comment->post->id)}}">View Post</a><br><a href="{{route('admin.posts.edit',$reply->comment->post->id)}}">Edit Post</a></td>
        <td>{{$reply->created_at}}</td>
        <td>{{$reply->updated_at}}</td>
        </tr>
              
        @endforeach
    

            
    </tbody>
  </table>
@else
    <H1>No reply</H1>
@endif
@endsection