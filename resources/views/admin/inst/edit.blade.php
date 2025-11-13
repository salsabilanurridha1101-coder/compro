@extends('admin.app')
@section('title', 'Instructor Edit')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <h1>{{ $error }}</h1>
        @endforeach
    @endif
    <form action="{{ route('inst-admin.update', $inst->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-2">
            <label class="form-label">Image</label>
            <div class="my-2">
                <img src="{{ asset('storage/' . $inst->image) }}" width="120px" height="" alt="">
            </div>
            <input type="file" class="form-control" name="image" accept=".jpg,.png,.jpeg,.jfif">
        </div>
        <div class="mb-2">
            <label class="form-label">Sosial Media</label>
            <input type="text" class="form-control" name="sosmed" value="{{ implode(',', $inst->sosmed) }}" data-role="tagsinput"
                placeholder="Isi Sosial Media dan Enter">
        </div>
         <div class="mb-2">
            <label class="form-label">Urls</label>
            <input type="url" class="form-control" name="sosmed_urls" value="{{ implode(',', $inst->sosmed_urls) }}" data-role="tagsinput">
        </div>
        <div class="mb-2">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" value="{{ $inst->nama }}">
        </div>
        <div class="mb-2">
            <label class="form-label">Jurusan</label>
            <input type="text" class="form-control" name="jurusan" value=" {{ $inst->jurusan }}">
        </div>
        <button type="submit" class="btn btn-info">Update</button>
        <a href="{{ url('inst-admin') }}" class="btn btn-secondary">Back</a>
    </form>
@endsection
