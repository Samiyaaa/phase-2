@extends('layouts.app')
@section('content')
@include('inc.sidebar')
@include('inc.messages')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           <h1>Roles</h1><i> </i><a href="/roles/create" class="btn btn-primary"><i>+</i> Add Role</a>
           @if (count($roles) > 0)
          <table class="table table-striped">
            <tr>
                <th>Role</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($roles as $role)
            <tr>
                <td>{{$role->role_name}}</td>
                <td><a href="/roles/{{$role->role_id}}/edit" class="btn btn-primary">Edit</a></td>
                <td><form action="{{ route('roles.destroy', $role->role_id) }}" method="POST" class="pull-right">
                    @csrf
                    <button type="submit" class="btn btn-danger"  name="delete" onclick="return confirm('Are you sure?')">
                        Delete
                     </button>
                     <input type="hidden" @method('DELETE')
                </form></td>
            </tr>  
            @endforeach
          </table>
          {{$roles->links()}}
    @else
        <p>No roles found</p>    
    @endif 
        </div>
    </div>
</div>  
@endsection