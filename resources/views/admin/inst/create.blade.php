@extends('admin.app')
@section('title', 'Instructur Menu')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <h1>{{ $error }}</h1>
        @endforeach
    @endif
    <form action="{{ route('inst-admin.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-2">
            <label class="form-label">Image</label>
            <input type="file" class="form-control" name="image" accept=".jpg,.png,.jpeg,.jfif">
        </div>
        <div class="mb-2">
            <label class="form-label">Sosial Media</label>
            <input type="text" class="form-control" name="sosmed" data-role="tagsinput"
                placeholder="Isi Sosial Media dan Enter">
        </div>
        <div class="mb-2">
            <label class="form-label">Urls</label>
            <input type="url" class="form-control" name="sosmed_urls" data-role="tagsinput" placeholder="Isi Url dan Enter">
        </div>
        <div class="mb-2">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama">
        </div>
        <div class="mb-2">
            <label class="form-label">Jurusan</label>
            <input type="text" class="form-control" name="jurusan">
        </div>
        <button type="submit" class="btn btn-info">Add</button>
        <a href="{{ url('inst-admin') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection
