@extends('admin.app')
@section('title', 'About Edit')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <h1>{{ $error }}</h1>
        @endforeach
    @endif
    <form action="{{ route('about-admin.update', $about->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-2">
            <label class="form-label">Image</label>
            <div class="my-2">
                <img src="{{ asset('storage/' . $about->image) }}" width="120px" height="" alt="">
            </div>
            <input type="file" class="form-control" name="image" accept=".jpg,.png,.jpeg">
        </div>
        <div class="mb-2">
            <label class="form-label">Features</label>
                <input type="text" class="form-control" name="feature" value="{{ implode(',', $about->feature) }}" data-role="tagsinput"
                placeholder="Isi Feature dan Click Enter">

        </div>
        <div class="mb-2">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title" value="{{ $about->title }}">
        </div>
        <div class="mb-2">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" cols="30" rows="5">{{ $about->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-info">Edit</button>
        <a href="{{ url('about-admin') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection
