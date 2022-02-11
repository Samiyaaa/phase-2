@extends('layouts.app')
@section('content')
@include('inc.sidebar')
@include('inc.messages')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Edit Tag</h1>
            <form action="{{ route('tags.update', $tag->tag_id) }}" method="POST">
                 @csrf
                <div class="form-group">
                    <label for="tag" class="col-form-label text-md-right">Tag Name</label>
                        <div class="col-md-6">
                            <input id="tag" type="text" class="form-control" name="tag" value="{{$tag->tag_name}}" placeholder="Tag" required="" >
                        </div>
                </div>
                    <input type="hidden" @method('PUT')
                    
                    <button type="submit" class="btn btn-primary" name="Submit">Update</button>
          
            </form>
        </div>
    </div>
</div>
@endsection