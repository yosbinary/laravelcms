@extends('layouts.admin')

@section('content')

  @if(Session::has('alert_message'))
    <div class="alert alert-success">{{Session::get('alert_message')}}</div>
  @endif
    <h1>Categories</h1>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
            <th scope="row">{{$category->id}}</th>
            <td><a href="{{route('admin.categories.edit',$category->id)}}">{{$category->name}}</a></td>
            <td>{{$category->created_at->diffForHumans()}}</td>
            <td>{{$category->updated_at->diffForHumans()}}</td>
            </tr>      
            @endforeach
          
         
        </tbody>
      </table>
    
@endsection