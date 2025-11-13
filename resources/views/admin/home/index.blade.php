@extends('admin.app')
@section('title', 'Home Menu')
@section('content')
    <div class="table-responsive">
        <div class="d-flex justify-content-end">
            <a href="{{ route('home-admin.create') }}" class="btn btn-info my-2">ADD</a>
        </div>
        <table class="table table-bordered text-center">
            <thead>
                <tr> 
                    <th>No</th>
                    <th>Image</th>
                    <th>Subtitle</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($homes as $index => $v)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><img src="{{ asset('storage/' . $v->image) }}" width="100px" height="" alt=""></td>
                        <td>{{ $v->subtitle }}</td>
                        <td>{{ $v->title }}</td>
                        <td>{{ $v->description }}</td>
                        <td>
                            <a href="{{ route('home-admin.edit', $v->id) }}" class="btn btn-warning btn-sm">Edit</a><br>
                            <form action="{{ route('home-admin.destroy', $v->id) }}" method="post" onsubmit="return confirm('R u sure wanna delete it')"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
