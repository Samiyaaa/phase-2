@extends('layouts.app')
@section('content')
@include('inc.sidebar')
@include('inc.messages')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Blogs</h1>
            <h3><a href="/blogs/create" class="btn btn-primary"><i>+</i>Create blog</a></h3>
            <br>
            @if (count($blogs) > 0)
                @foreach ($blogs as $blog)
                    <div class="well">
                        <div class="row">
                            <div class="col-md-4 col-md-4">
                        <img style="width:50%" src="/storage/blog_images/{{$blog->blog_image}}" alt="">
                            </div>
                            <div class="col-md-8 col-md-8">
                                <h3><a href="/blogs/{{$blog->blog_id}}">{{$blog->title}}</a></h3> 
                                @foreach ($blog->blogTag as $blogTag)
                                    <i>#{{ $blogTag->tag->tag_name}}</i>
                                @endforeach
                                <br>
                                <small>Written on {{$blog->created_at}} by {{$blog->user->name}}</small>
                            </div>
                        </div>
                    </div>
                    <br>
                @endforeach
            {{$blogs->links()}}
            @else
                <p>No blogs found</p>    
            @endif  
        </div>
    </div>
</div>
@endsection
