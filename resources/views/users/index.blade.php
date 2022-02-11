@extends('layouts.app')
@section('content')
@include('inc.sidebar')
@include('inc.messages')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           <h1>Users</h1><i> </i><a href="/users/create" class="btn btn-primary"><i>+</i> Add User</a>
           @if (count($users) > 0)
          <table class="table table-striped">
            <tr>
                <th>User</th>
                <th>Email Address</th>
                <th>Roles</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($users as $user)
            <tr>
                <td><a href="#">{{$user->name}}</a></td>
                <td>{{$user->email}}</td>
                <td>
                @foreach ($user->roleUser as $roleUser)
                    <p>{{ $roleUser->role->role_name}}</p>
                @endforeach</td>
                <td><a href="/users/{{$user->id}}/edit" class="btn btn-primary">Edit</a></td>
                <td><a href=""></a><form action="{{ route('users.destroy', $user->id) }}" method="POST" class="pull-right">
                    @csrf
                    <button type="submit" class="btn btn-danger"  name="delete">
                        Delete
                     </button>
                     <input type="hidden" @method('DELETE')
                </form></td>
            </tr>  
            @endforeach
          </table>
          {{$users->links()}}
    @else
        <p>No users found</p>    
    @endif 
        </div>
    </div>
</div>  
@endsection