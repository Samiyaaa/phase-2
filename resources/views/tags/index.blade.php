@extends('layouts.app')
@section('content')
@include('inc.sidebar')
@include('inc.messages')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           <h1>Tags</h1><i> </i><a href="/tags/create" class="btn btn-primary"><i>+</i> Add Tag</a>
           @if (count($tags) > 0)
          <table class="table table-striped">
            <tr>
                <th>Tag</th>
                <th></th>
                <th></th>
            </tr>
            @foreach($tags as $tag)
            <tr>
                <td>{{$tag->tag_name}}</td>
                <td><a href="/tags/{{$tag->tag_id}}/edit" class="btn btn-primary">Edit</a></td>
                <td><form action="{{ route('tags.destroy', $tag->tag_id) }}" method="POST" class="pull-right">
                    @csrf
                    <button type="submit" class="btn btn-danger"  name="delete" onclick="return confirm('Are you sure?')">
                        Delete
                     </button>
                     <input type="hidden" @method('DELETE')
                </form></td>
            </tr>  
            @endforeach
          </table>
          {{$tags->links()}}
    @else
        <p>No tags found</p>    
    @endif 
        </div>
    </div>
</div>  
@endsection