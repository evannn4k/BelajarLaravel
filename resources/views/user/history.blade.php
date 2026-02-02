@extends('layout.user-layout')

@section('content')
    <div class="container">
        <div class="py-5 row">
            <div class="col-md-8 offset-md-2 p-3 border rounded-3 shadow">
                <table class="table table-bordered-table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Nama Event</th>
                            <th>Status</th>
                            <th>Pada</th>
                            <th>Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($user->registration as $registration)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $registration->event->title }}</td>
                                <td>
                                    @if ($registration->status == 'approved')
                                        <div class="badge text-bg-primary">
                                            {{ $registration->status }}
                                        </div>
                                    @else
                                        <div class="badge text-bg-danger">
                                            {{ $registration->status }}
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $registration->created_at->diffForHumans() }}</td>
                                <td>
                                    @if (!$registration->payment_proof)
                                        <a href="{{ route('payment.event', $registration->id) }}"
                                            class="btn btn-success btn-sm">Bayar</a>
                                    @else
                                        <div>Sudah dibayar</div>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <td colspan="5" class="text-center">Belum ada pesanan</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
