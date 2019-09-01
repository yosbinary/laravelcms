@extends('layouts.admin')

@section('content')
<h1>Create Category</h1>
<div class="row">
    <form method="POST" action="/admin/categories" enctype="multipart/form-data" >
        @csrf
            <div class="form-group">
                    <label for="title">name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="">
                    
            </div>
           
            
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>
<div class="row" style="margin-top: 20px">
        @include('includes.formerror')
</div>
@endsection