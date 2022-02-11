@extends('layouts.app')
@section('content')
@include('inc.sidebar')
@include('inc.messages')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
    <a href="/blogs" class="btn-default">Go Back</a>
    <h1>{{$blog->title}}</h1>
    <img style="width:50%" src="/storage/blog_images/{{$blog->blog_image}}" alt="">
    <div>
        {!!$blog->content!!}
    </div>
    <hr>
    <small>Written on {{$blog->created_at}} by {{$blog->user->name}}</small>
    @if (!Auth::guest())
        @if (Auth::user()->id == $blog->user_id)
        <div class="well">
            <div class="row">
                <div class="col-md-4 col-md-4">
            <a class="btn btn-primary" href="/blogs/{{$blog->blog_id}}/edit" role="button">Edit</a>
                </div>
            <div class="col-md-8 col-md-8">
                <form action="{{ route('blogs.destroy', $blog->blog_id) }}" method="POST" class="pull-right">
                @csrf
                <button type="submit" class="btn btn-danger"  name="delete" onclick="return confirm('Are you sure?')">
                    Delete
                </button>
                <input type="hidden" @method('DELETE')
            </form>
            </div>
            </div>
        </div>   
        @endif
        
     @endif
@endsection