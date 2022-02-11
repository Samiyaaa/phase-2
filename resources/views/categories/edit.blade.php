@extends('layouts.app')
@section('content')
@include('inc.sidebar')
@include('inc.messages')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <h2>Edit Category</h2>
        {!! Form::open(['action' => ['App\Http\Controllers\CategoriesController@update', $category->category_id] , 'method' => 'POST', 'enctype' =>'multipart/form-data']) !!}
                    <div class="form-group">
                        {{Form::label('category', 'Name')}}
                        
                        {{Form::text('category', $category->category_name, ['class' => 'form-control ', 'placeholder' => ''])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('category_desc', 'Description')}}
                        {{Form::text('category_desc', $category->category_desc, ['class' => 'form-control ', 'placeholder' => ''])}}
                    </div>
                    <br>
                    <div class="form-group">
                        {{Form::file('category_image')}}
                    </div>
                    <br> 
                    {{Form::hidden('_method','PUT')}}
                    {{Form::submit('Update',['class' => 'btn btn-primary'])}}
                   
        {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
