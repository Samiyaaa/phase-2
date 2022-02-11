@extends('layouts.app')
@section('content')
@include('inc.sidebar')
@include('inc.messages')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <h2>Edit Blog</h2>
        {!! Form::open(['action' => ['App\Http\Controllers\BlogsController@update', $blog->blog_id] , 'method' => 'POST', 'enctype' =>'multipart/form-data']) !!}
                    <div class="form-group">
                        {{Form::label('blog', 'Blog Title')}}
                        
                        {{Form::text('title', $blog->title, ['class' => 'form-control ', 'placeholder' => ''])}}
                        
                    </div>
                    <div class="form-group">
                        {{Form::label('category', 'Category')}}
                        {{Form::select('category_id' , $categories, $blog->category->category_id, ['class' => 'form-control ','placeholder' => $blog->category->category_name])}}
                        
                    </div>
                    {{$selectedTags}}
                    <div class="form-group">
                        {{Form::label('tag', 'Tag')}}
                        {{Form::select('tag_ids[]', $tags, null, ['class' => 'js-example-basic-multiple form-control ', 'multiple' => 'multiple'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('content', 'Content')}}
                        <textarea name="content" class="my-editor form-control" id="my-editor">{{$blog->content}}</textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        {{Form::file('blog_image')}}
                    </div>
                    <br> 
                    {{Form::hidden('_method','PUT')}}
                    {{Form::submit('Update',['class' => 'btn btn-primary'])}}
                   
        {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
