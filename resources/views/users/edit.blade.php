@extends('layouts.app')
@section('content')
@include('inc.sidebar')
@include('inc.messages')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <h2>Edit User</h2>
        {!! Form::open(['action' => ['App\Http\Controllers\UsersController@update', $user->id] , 'method' => 'POST']) !!}
                    <div class="form-group">
                        {{Form::label('name', 'Name')}}
                        <div class="col-md-6">
                        {{Form::text('name', $user->name, ['class' => 'form-control ', 'placeholder' => ''])}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('email', 'E-mail Address')}}
                        <div class="col-md-6">
                        {{Form::email('email', $user->email, ['class' => 'form-control ', 'placeholder' => ''])}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('role', 'Role')}}
                        <div class="col-md-6">
                        {{Form::select('role_ids[]' , $roles, null, ['class' => 'js-example-basic-multiple form-control','multiple' => 'multiple'])}}
                    </div>
                    </div>
                    <div class="form-group">
                        {{Form::hidden('_method','PUT')}}
                        {{Form::submit('Update',['class' => 'btn btn-primary'])}}
                    </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
