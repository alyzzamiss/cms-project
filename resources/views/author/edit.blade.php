@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-header">New Blog Post</div>
    <div class="card-body">
        <form action="{{route('author.blogs.update', $blog)}}" method="POST">
            @csrf
            {{method_field('PUT')}}
            <div class="form-group">
                <label for="title" name="title">Title</label>
                <input type="text" class="form-control" id="title" name ="title" value="{{$blog->title}}" required>
            </div>
            <div class="form-group">
                <label for="body" name="body">Content</label>
                <textarea class="form-control" id="body" rows="3" name ="body" required>{{$blog->body}}</textarea>
            </div>
            <div class="form-group">
                <label for="upload_img">Upload Image</label>
                <input type="file" class="form-control-file" id="upload_img" accept=".png,.jpg,.jpeg">
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
            <button type="reset" class="btn btn-warning btn-sm">Reset</button>
        </form>
    </div>
</div> 
@endsection