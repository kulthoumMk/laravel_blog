@extends('layouts.app')

@section('title') Edit @endsection

@section('content')
<form action="{{route('posts.update', $post->id)}}" method="POST">
    @csrf
    @method('PUT') 
<div class="mb-3">
  <label  class="form-label">Title</label>
  <input name="title" type="text" value="{{$post->title}}"  class="form-control">
</div>
<div class="mb-3">
  <label class="form-label">Description</label>
  <textarea name="description" class="form-control" rows="3">{{$post->description}}</textarea>
</div>
<div class="mb-3">
<label  class="form-label">Post creator</label>
<select name="post_creator" class="form-select" aria-label="Default select example">
  @foreach($users as $user)
  <!-- <option @if ( $user->id == $post->user_id ) selected  @endif value="{{$user->id}}">{{$user->name}}</option> -->
  <option @selected ( $user->id == $post->user_id ) value="{{$user->id}}">{{$user->name}}</option>
  @endforeach
</select>
</div>
<button type="submit" class="btn btn-primary">Update</button>
</form>

@endsection
