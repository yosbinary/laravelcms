@extends('layouts.admin')

@section('content')
@if (Session::has('alert_message'))
<div class="alert alert-success" >
  {{session('alert_message')}}
</div>
   
@endif

<div class="mb-30"><a class="btn btn-primary" href="/admin/users/create" role="button">Create New User</a></div>
<h1>Users</h1>

<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Photo</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Role</th>
        <th scope="col">Is Active</th>
        <th scope="col">Created At</th>
        <th scope="col">Updated At</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
        <th scope="row">{{$user->id}}</th>
        <td><img src="{{($user->photo)?$user->photo->file:'/images/nophoto.png'}}" style="width:100px;max-height:100px"></td>
        <td><a href="{{route('admin.users.edit',$user->id)}}">{{$user->name}}</a></td>
        <td>{{$user->email}}</td>
        <td>{{$user->role->name}}</td>
        <td>{{$user->is_active == 1 ? 'Active' : 'Not active'}}</td>
        <td>{{$user->created_at->diffForHumans()}}</td>
        <td>{{$user->updated_at->diffForHumans()}}</td>
        
              </tr>
        @endforeach
      
      
    </tbody>
  </table>
  
    
@endsection