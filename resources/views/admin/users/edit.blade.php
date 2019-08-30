@extends('layouts.admin')

@section('content')
<h1>Edit User</h1>
<div class="col-sm-3">
<img src="{{$user->photo? $user->photo->file : "/images/nophoto.png"}}" alt="{{$user->name}}" style="width: 200px;max-height: 200px">
</div>
<div class="col-sm-9">
    <form method="POST" action="{{route('admin.users.update',$user->id)}}" enctype="multipart/form-data" >
        @csrf
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="{{$user->id}}">
            <input type="hidden" name="photo_id" value="{{$user->photo_id}}">
            <div class="form-group">
                    <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name"  placeholder="Enter Your Name" value="{{$user->name}}" >
                    
            </div>
            <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" name ="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" value="{{$user->email}}">
            <small id="emailHelp"  class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Enter New Password">
            </div>
            <div class="form-group">
            @foreach ($roles as $role)
            <div class="form-check">
                    <input class="form-check-input" type="radio" name="role_id"  value="{{$role->id}}" {{$user->role_id == $role->id ? 'checked' : ""}}>
                    <label class="form-check-label" for="exampleRadios1">
                    {{$role->name}}
                    </label>
                </div>
            @endforeach
            </div>

            <div class="form-group">
                
                <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_active  value="1" {{$user->is_active == 1? 'checked' : ""}}>
                        <label class="form-check-label" for="exampleRadios1">
                        Active
                        </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_active"  value="0" {{($user->is_active == 0)?'checked' : ""}}>
                    <label class="form-check-label" for="exampleRadios1">
                    Not Active
                    </label>
            </div>
            
            </div>
                    
            <input type="hidden" name="is_active" value="0">
            <div class="form-group">
                    <input type="file" class="form-control-file" name="file" id="exampleInputFile">
            </div>
            @include('includes.formerror')
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>

        
    </div>
    


@endsection