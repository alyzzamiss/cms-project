@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <h3>Read Blogs</h3>
            @foreach ($blogs as $blog)
                <div class="card mb-4">
                    <div class="card-header"><a href="">{{$blog->title}}</a></div>
                    <div class="card-body">{{$blog->body}} <br>
                        <small>{{$blog->created_at}}</small>
                    </div>                        
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
