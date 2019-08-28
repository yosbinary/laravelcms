@extends('layouts.admin')

@section('content')
<h1>Create User</h1>
<form method="POST" action="/admin/users" enctype="multipart/form-data" >
    @csrf
        <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Your Name">
                
        </div>
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" name ="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
          <small id="emailHelp"  class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control" id="password" placeholder="Password">
        </div>
        <div class="form-group">
        @foreach ($roles as $role)
        <div class="form-check">
                <input class="form-check-input" type="radio" name="role_id"  value="{{$role['id']}}">
                <label class="form-check-label" for="exampleRadios1">
                {{$role['name']}}
                </label>
            </div>
        @endforeach
        </div>
                  
        <input type="hidden" name="is_active" value="0">
        <div class="form-group">
                <input type="file" class="form-control-file" name="file" id="exampleInputFile">
        </div>
        @include('includes.formerror')
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </form>

@endsection