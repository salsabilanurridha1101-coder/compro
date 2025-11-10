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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

