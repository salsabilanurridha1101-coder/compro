@extends('admin.app')
@section('title', 'Home Update')
@section('content')
@if($errors->any())
@foreach ($errors->all() as $error)
<h1>{{ $error }}</h1>
@endforeach
@endif
<form action="{{ route('home-admin.update', $home->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="mb-2">
        <label class="form-label">Image</label>
        <div>
            <img src="{{ asset('storage/'. $home->image) }}" width="120" alt="">
        </div>
        <input type="file" class="form-control" name="image" accept=".jpg,.png,.jpeg" >
    </div>
    <div class="mb-2">
        <label  class="form-label">Subtitle</label>
        <input value="{{ $home->subtitle }}" type="text" class="form-control" name="subtitle">
    </div>
    <div class="mb-2">
        <label class="form-label">Title</label>
        <input value="{{ $home->title }}" type="text" class="form-control" name="title">
    </div>
    <div class="mb-2">
        <label class="form-label">Description</label>
        <textarea class="form-control" name="description" cols="30" rows="5">{{ trim($home->title) }}</textarea>
    </div>
    <button type="submit" class="btn btn-warning">Update</button>
    <a href="{{ url('home-admin') }}" class="btn btn-secondary">Back</a>

</form>
@endsection
