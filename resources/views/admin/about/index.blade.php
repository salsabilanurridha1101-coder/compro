@extends('admin.app')
@section('title', 'About Menu')
@section('content')
    <div class="table-responsive">
        <div class="d-flex justify-content-end">
            <a href="{{ route('about-admin.create') }}" class="btn btn-info my-2">ADD</a>
        </div>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>feature</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($abouts as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><img src="{{ asset('storage/' . $item->image) }}" width="120px" height="" alt=""></td>
                        <td>{{ $item->title }}</td>
                        {{-- <td>{{$item->feature}}</td> --}}
                        <td>
                            <ul>
                                @foreach ($item->feature as $i)
                                    <li>{{ $i }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <a href="{{ route('about-admin.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('about-admin.destroy', $item->id) }}" method="post" onsubmit="return confirm('R u sure wanna delete it')"
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
