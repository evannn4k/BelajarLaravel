@extends('layout.admin-layout')

@section('content')
    <div class="p-3">
        <div class="container">
            <div class="pb-3">
                <a href="{{ route('admin.event.create') }}" class="btn btn-primary">Create Event</a>
            </div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quota</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($events as $event)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->category }}</td>
                            <td>{{ $event->description }}</td>
                            <td>{{ $event->price }}</td>
                            <td>{{ $event->quota }}</td>
                            <td>{{ $event->status }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('admin.event.edit', $event->slug) }}"
                                        class="btn btn-success btn-sm">edit</a>
                                    {{-- <a href="{{ route("event.edit", $event->slug) }}" class="btn btn-danger btn-sm">delete</a> --}}
                                    <form action="{{ route('admin.event.delete', $event->slug) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
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
