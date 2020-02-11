@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="row">
            <div class="col-6">
                <h3 class="float-left">My Blogs</h3>
            </div>
            <div class="col-6">
                <a href="{{route('author.blogs.create')}}"><button class="btn btn-primary float-right btn-sm">Create New Blog</button></a>
            </div>                
        </div>        
        @foreach ($blogs-> sortByDesc('created_at') as $blog)
            <div class="card mb-4">
                <div class="card-header"><a href="">{{$blog->title}}</a></div>
                <div class="card-body">{{$blog->body}}<br>
                    @can('edit-blogs')
                        <a href="{{ route('author.blogs.edit', $blog->id)}}"><button class="btn btn-primary btn-sm float-left mt-2">Edit</button></a>
                    @endcan
                    @can('delete-blogs')
                        <form action="{{ route('author.blogs.destroy', $blog)}}" method="POST" class="float-left">
                            @csrf
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-warning btn-sm mt-2">Delete</button>
                        </form>
                    @endcan
                </div>
                <div class="card-footer">
                    <small>{{$blog->created_at->format('m/d/Y')}}</small>
                </div>                        
            </div>
        @endforeach
        </div>
    </div>
</div>
@endsection