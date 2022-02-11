@extends('layouts.app')
@section('content')
@include('inc.sidebar')
@include('inc.messages')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           <h1>Categories</h1><i> </i><a href="/categories/create" class="btn btn-primary"><i>+</i> Create Category</a>
           @if (count($categories) > 0)
          <table class="table table-striped">
            <tr>
                <th>Category</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($categories as $category)
            <tr>
                <td><a href="/categories/{{$category->category_id}}">{{$category->category_name}}</td>
                <td><a href="/categories/{{$category->category_id}}/edit" class="btn btn-primary">Edit</a></td>
                <td><a href=""></a><form action="{{ route('categories.destroy', $category->category_id) }}" method="POST" class="pull-right">
                    @csrf
                    <button type="submit" class="btn btn-danger"  name="delete" onclick="return confirm('Are you sure?')">
                        Delete
                     </button>
                     <input type="hidden" @method('DELETE')
                </form></td>
            </tr>  
            @endforeach
        </table>
        {{$categories->links()}}
    @else
        <p>No blogs found</p>    
    @endif 
        </div>
    </div>
</div>  
@endsection