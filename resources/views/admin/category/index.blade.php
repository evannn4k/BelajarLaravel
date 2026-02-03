@extends('layout.admin-layout')

@section('content')
<div class="p-3">
    <div class="container">
        <div class="pb-3">
            <a href="{{ route('admin.category-event.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Kategori</a>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Slug</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.category-event.edit', $category->slug) }}"
                                class="btn btn-success btn-sm"><i class="fa fa-pen-to-square"></i></a>
                            <form action="{{ route('admin.category-event.delete', $category->slug) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection