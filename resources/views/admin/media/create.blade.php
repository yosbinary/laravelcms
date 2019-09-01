@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css">
@endsection
@section('content')
<h1>Upload a file</h1>
<div class="row">
    <form method="POST" action="/admin/media" enctype="multipart/form-data" class="dropzone" >
        @csrf
        
            
           
            
    </form>
</div>
<div class="row" style="margin-top: 20px">
        @include('includes.formerror')
</div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
@endsection