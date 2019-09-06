@extends('layouts.blog-post')
@section('content')
  <!-- Blog Post -->

                <!-- Title -->
<h1>{{$post->title}}</h1>

                <!-- Author -->
                <p class="lead">
                by <a href="#">{{$post->user->name}}</a>
                </p>

                <hr>

                <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->isoFormat('dddd D')}}</p>

                <hr>

                <!-- Preview Image -->
            <img class="img-responsive" src="{{$post->photo->file}}" alt="{{$post->title}}">

                <hr>

                <!-- Post Content -->
                {{$post->body}}
                <hr>

                <!-- Blog Comments -->
                @if(Auth::check())
                
                    @if(Session::has('alert_message'))
                    <div class="alert alert-success">{{Session::get('alert_message')}}</div>
                    @endif

                    <!-- Comments Form -->
                    <div class="well">
                        <h4>Leave a Comment:</h4>
                    <form role="form" action="{{route('admin.comments.store')}}" method="POST">
                        @csrf    
                    <input type="hidden" name="user_id" value="{{$user->id}}">
                    <input type="hidden" name="post_id" value="{{$post->id}}">
                        <div class="form-group">
                                <textarea class="form-control" rows="3" name="body"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                @else
                <a class="btn btn-primary" href="{{route('login')}}">Leave A Comment</a>
                @endif
                <hr>

                <!-- Posted Comments -->
@if(count($comments)>0)
            @foreach ($comments as $comment)
                <!-- Comment -->
                @if($comment->is_active == 1)
                <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">{{$comment->author}}
                            <small>{{$comment->created_at->isoFormat('dddd DD hh:mm')}}</small>
                            </h4>{{$comment->body}}
                            <!-- Nested Comment -->
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">Nested Start Bootstrap
                                        <small>August 25, 2014 at 9:30 PM</small>
                                    </h4>
                                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                </div>
                            </div>
                            <!-- End Nested Comment -->
                        <div class="well">
                            <form action="{{route('replies.create')}}" method="POST">
                            @csrf
                            <input type="hidden" name="comment_id" value="{{$comment->id}}">
                            <textarea name="body" class="form-control" rows="1"></textarea>
                            <button class="btn btn-primary" type="submit">reply</button>
                            </form>  
                        </div>                        
                    </div>
                </div>
                @endif
                
            @endforeach
                
@endif

    
@endsection