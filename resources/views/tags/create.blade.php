@extends('layouts.app')
@section('content')
@include('inc.sidebar')
@include('inc.messages')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <h2>Create Tag</h2>
        {!! Form::open(['action' => 'App\Http\Controllers\TagsController@store' , 'method' => 'POST']) !!}
                    <div class="form-group">
                        {{Form::label('tag', 'Tag Name')}}
                        <div class="col-md-6">
                        {{Form::text('tag', '', ['class' => 'form-control ', 'placeholder' => 'Tag'])}}
                        </div>
                    </div>
                    <br>
                    {{Form::submit('Save',['class' => 'btn btn-primary'])}}
            
        {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
