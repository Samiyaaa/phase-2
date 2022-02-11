@extends('layouts.app')
@section('content')
@include('inc.sidebar')
@include('inc.messages')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
    <a href="/categories" class="btn-default">Go Back</a>
    <h1>{{$category->category_name}}</h1>
    <img style="width:100%" src="/storage/category_images/{{$category->category_image}}" alt="">
    <div>
        {!!$category->category_desc!!}
    </div>
    <hr>
    @if (!Auth::guest())
        <div class="well">
            <div class="row">
                <div class="col-md-4 col-md-4">
            <a class="btn btn-primary" href="/categories/{{$category->category_id}}/edit" role="button">Edit</a>
                </div>
            <div class="col-md-8 col-md-8">
                <form action="{{ route('categories.destroy', $category->category_id) }}" method="POST" class="pull-right">
                @csrf
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')"  name="delete">
                    Delete
                </button>
                <input type="hidden" @method('DELETE')
            </form>
            </div>
            </div>
        </div>   
        
        
     @endif
@endsection