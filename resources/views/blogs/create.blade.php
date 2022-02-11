@extends('layouts.app')
@section('content')
@include('inc.sidebar')
@include('inc.messages')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <h2>Create Blog</h2>
        {!! Form::open(['action' => 'App\Http\Controllers\BlogsController@store' , 'method' => 'POST', 'enctype' =>'multipart/form-data']) !!}
                    <div class="form-group">
                        {{Form::label('blog', 'Blog Title')}}
                        
                        {{Form::text('title', '', ['class' => 'form-control ', 'placeholder' => ''])}}
                        
                    </div>
                    <div class="form-group ">
                        {{Form::label('category', 'Category')}}
                        {{Form::select('category_id' , $categories, null, ['class' => 'form-control','placeholder' => ''])}}
                        
                    </div>
                    <div class="form-group">
                        {{Form::label('tag', 'Tag')}}
                        {{Form::select('tag_ids[]', $tags, null, ['class' => 'js-example-basic-multiple form-control','multiple' => 'multiple'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('content', 'Content')}}
                        <textarea name="content" class="my-editor form-control" id="my-editor"></textarea>
                    </div>
                    <br>
                    <div class="form-group">
                        {{Form::file('blog_image')}}
                    </div>
                    <br>
                    {{Form::submit('Save',['class' => 'btn btn-primary'])}}
            
        {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
