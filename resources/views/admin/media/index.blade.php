@extends('layouts.admin');
@section('content')
@if (Session::has('alert_message'))
<div class="alert alert-success" >
  {{session('alert_message')}}
</div>
 
@endif
<h1>Media</h1>
<table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">file</th>
            <th scope="col">created_at</th>
            <th scope="col">updated_at</th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($photos as $photo)
          <tr>
          <th scope="row">{{$photo->id}}</th>
          <td><img src="{{$photo->file}}" alt="" class="img-responsive" style="width:200px"></td>
          <td>{{$photo->created_at}}</td>
          <td>{{$photo->updated_at}}</td>
          <td>
          <form action="{{route('admin.media.destroy',$photo->id)}}" method="POST">
          @csrf
          <input type="hidden" name="_method" value="DELETE">
          <button class="btn btn-danger">DELETE</button>
        </form>
          </td>
        </tr>    
          @endforeach
          
          
        </tbody>
      </table>    
@endsection