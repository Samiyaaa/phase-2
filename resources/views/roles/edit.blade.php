@extends('layouts.app')
@section('content')
@include('inc.sidebar')
@include('inc.messages')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Edit Role</h1>
            <form action="{{ route('roles.update', $role->role_id) }}" method="POST">
                 @csrf
                <div class="form-group">
                    <label for="role" class="col-form-label text-md-right">Role Name</label>
                        <div class="col-md-6">
                            <input id="role" type="text" class="form-control" name="role" value="{{$role->role_name}}" placeholder="Role" required="" >
                        </div>
                </div>
                    <input type="hidden" @method('PUT')
                    
                    <button type="submit" class="btn btn-primary" name="Submit">Update</button>
          
            </form>
        </div>
    </div>
</div>
@endsection