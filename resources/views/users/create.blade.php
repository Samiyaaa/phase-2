@extends('layouts.app')
@section('content')
@include('inc.sidebar')
@include('inc.messages')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <h2>Add User</h2>
        {!! Form::open(['action' => 'App\Http\Controllers\UsersController@store' , 'method' => 'POST']) !!}
                    <div class="form-group">
                        {{Form::label('name', 'Name')}}
                        <div class="col-md-6">
                        {{Form::text('name', '', ['class' => 'form-control ', 'placeholder' => 'Name'])}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('email', 'E-mail Address')}}
                        <div class="col-md-6">
                        {{Form::email('email', '', ['class' => 'form-control ', 'placeholder' => 'Email Address'])}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('password', 'Password')}}
                        <div class="col-md-6">
                        {{Form::password('password', ['class' => 'form-control ', 'placeholder' => 'Password'])}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('password-confirm', 'Confirm password')}}
                        <div class="col-md-6">
                        {{Form::password('password-confirm', ['class' => 'form-control ', 'placeholder' => 'Confirm password'])}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('role', 'Role')}}
                        <div class="col-md-6">
                        {{Form::select('role_ids[]' , $roles, null, ['class' => 'js-example-basic-multiple form-control','multiple' => 'multiple'])}}
                    </div>
                    </div>
                    <div class="form-group">
                        {{Form::submit('Save',['class' => 'btn btn-primary'])}}
                    </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
