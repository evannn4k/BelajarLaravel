@extends('layout.admin-layout')

@section('content')
    <div class="p-3">
        <div class="container">
            <div class="pb-3">
                <a href="{{ route('admin.user.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah
                    Pengguna</a>
            </div>
            <div class="table-responsive w-100">

                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Peran</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        @if ($user->avatar)
                                            <div class="ratio ratio-1x1" style="max-width: 32px">
                                                <img src="{{ asset("storage/images/avatar/$user->avatar") }}" alt=""
                                                    class="object-fit-cover img-fluid rounded-circle" width="32px">
                                            </div>
                                        @else
                                            <div class="ratio ratio-1x1" style="max-width: 32px">
                                                <img src="{{ asset('images/default.jpg') }}" alt=""
                                                    class="object-fit-cover img-fluid" width="32px">
                                            </div>
                                        @endif
                                        {{ $user->name }}
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.user.edit', $user->id) }}"
                                            class="btn btn-success btn-sm"><i class="fa fa-pen-to-square"></i></a>
                                        <form action="{{ route('admin.user.delete', $user->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="fa fa-trash"></i></button>
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
    </div>
@endsection
