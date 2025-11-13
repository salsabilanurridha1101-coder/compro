@extends('admin.app')
@section('title', 'Instructor Menu')
@section('content')
    <div class="table-responsive">
        <div class="d-flex justify-content-end">
            <a href="{{ route('inst-admin.create') }}" class="btn btn-info my-2">ADD</a>
        </div>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Image</th>
                    <th>Sosial Media</th>
                    <th>Sosmed Url</th>
                    <th>Nama</th>
                    <th>Jurusan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inst as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><img src="{{ asset('storage/' . $item->image) }}" width="120px" height="" alt=""></td>
                        <td>
                            <ul>
                                @php
                                    $instructor_icon = $item->sosmed ?? [];
                                @endphp
                                @foreach ($item->sosmed as $i)
                                    <li>{{ $i }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <ul>
                                @php
                                    $instructor_url = $item->sosmed_urls ?? [];
                                @endphp

                                @foreach ($instructor_url as $ins_url)
                                    <li>{{ $ins_url }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->jurusan }}</td>
                        {{-- <td>{{$item->feature}}</td> --}}
                        <td>
                            <a href="{{ route('inst-admin.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('inst-admin.destroy', $item->id) }}" method="post"
                                onsubmit="return confirm('R u sure wanna delete it')" class="d-inline">
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
