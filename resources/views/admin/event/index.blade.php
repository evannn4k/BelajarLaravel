@extends('layout.admin-layout')

@section('content')
    <div class="p-3">
        <div class="container">
            <div class="pb-3">
                <a href="{{ route('admin.event.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Event</a>
            </div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Kaategori</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Kuota</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($events as $event)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->category->name }}</td>
                            <td>{{ Str::limit($event->description, 50) }}</td>
                            <td>Rp. {{ number_format($event->price) }}</td>
                            <td>{{ number_format($event->quota) }}</td>
                            <td>
                                @if ($event->status)
                                    <div class="badge text-bg-primary">
                                        Aktif
                                    </div>
                                @else
                                    <div class="badge text-bg-danger">
                                        Tidak Aktif
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.event.detail', $event->slug) }}"
                                        class="btn btn-primary btn-sm">detail</a>
                                    <a href="{{ route('admin.event.edit', $event->slug) }}"
                                        class="btn btn-success btn-sm"><i class="fa fa-pen-to-square"></i></a>
                                    {{-- <a href="{{ route("event.edit", $event->slug) }}" class="btn btn-danger btn-sm">delete</a> --}}
                                    <form action="{{ route('admin.event.delete', $event->slug) }}" method="post">
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
