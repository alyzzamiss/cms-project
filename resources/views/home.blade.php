@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <h3>Read Blogs</h3>
            @foreach ($blogs-> sortByDesc('created_at') as $blog)
                <div class="card mb-4">
                    <div class="card-header"><a href="">{{$blog->title}}</a></div>
                    <div class="card-body">
                        <p>{{$blog->body}}</p>
                        <small>{{$blog->created_at->format('m/d/Y')}}</small>
                    </div>
                    <div class="card-footer">
                        <div class="section mb-4">
                            @foreach ($comments->sortByDesc('created_at') as $comment)
                                @if ($blog->id == $comment ->post_id)
                                    <p>{{$comment->comment}}
                                    <small>{{$comment->created_at->format('m/d/Y')}}</small></p>
                                @endif
                            @endforeach
                        </div>
                        <div class="section">
                            @can('manage-comments')
                                <form action="{{route('user.comments.store')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="comment">Comment:</label>
                                        <textarea class="form-control form-control-sm" name="comment" id="comment" cols="30" rows="2" required></textarea>
                                    </div>
                                    <input type="hidden" name="post_id" value="{{$blog->id}}">
                                    <button type="submit"class="btn btn-primary btn-sm float-right">Sumbit</button>
                                    <button type="reset"class="btn btn-secondary btn-sm float-right">Reset</button>
                                </form>                            
                            @endcan
                        </div>                        
                    </div>                        
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
