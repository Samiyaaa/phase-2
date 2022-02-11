@extends('layouts.app')
@section('content')
@include('inc.sidebar')
@include('inc.messages')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <h2>Create Category</h2>
        {!! Form::open(['action' => 'App\Http\Controllers\CategoriesController@store' , 'method' => 'POST', 'enctype' =>'multipart/form-data']) !!}
                    <div class="form-group">
                        {{Form::label('category', 'Category Name')}}
                        {{Form::text('category', '', ['class' => 'form-control ', 'placeholder' => ''])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('category_desc', 'Description')}}
                        {{Form::text('category_desc', '', ['class' => 'form-control ', 'placeholder' => ''])}}
                    </div>
                    <br>
                    <div class="form-group">
                        {{Form::file('category_image')}}
                    </div>
                    <br>
                    {{Form::submit('Save',['class' => 'btn btn-primary'])}}
            
        {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
