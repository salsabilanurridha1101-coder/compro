@extends('admin.app')
@section('title', 'About Menu')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <h1>{{ $error }}</h1>
        @endforeach
    @endif
    <form action="{{ route('about-admin.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-2">
            <label class="form-label">Image</label>
            <input type="file" class="form-control" name="image" accept=".jpg,.png,.jpeg">
        </div>
        <div class="mb-2">
            <label class="form-label">Features</label>
            <input type="text" class="form-control" name="feature" data-role="tagsinput"
                placeholder="Isi Feature dan Click Enter">
        </div>
        <div class="mb-2">
            <label class="form-label">Title</label>
            <input type="text" class="form-control" name="title">
        </div>
        <div class="mb-2">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" cols="30" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-info">Add</button>
        <a href="{{ url('about-admin') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection
