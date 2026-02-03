@extends('layout.user-layout')

@section('content')
    <div class="container">
        <div class="py-5 row">
            <div class="col-md-8 offset-md-2 p-3 border rounded-3 shadow">
                <table class="table table-bordered-table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Nama Event</th>
                            <th>Status</th>
                            <th>Pada</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($histories as $registration)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $registration->code_registration ?? "-" }}</td>
                                <td>{{ $registration->event->title }}</td>
                                <td>
                                    @if ($registration->status == 'approved')
                                        <div class="badge text-bg-success">
                                            Sudah dibayar
                                        </div>
                                    @elseif($registration->status == 'rejected')
                                        <div class="badge text-bg-danger">
                                            Ditolak
                                        </div>
                                    @elseif($registration->status == 'pending' && !$registration->payment_proof)
                                        <div class="badge text-bg-secondary">
                                            Belum dibayar
                                        </div>
                                    @else
                                        <div class="badge text-bg-warning">
                                            Sedang validasi
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $registration->created_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('payment.event', $registration->code_registration ?? 1) }}"
                                        class="btn btn-primary btn-sm">Lihat Detail</a>
                                </td>
                            </tr>
                        @empty
                            <td colspan="5" class="text-center">Belum ada pesanan</td>
                        @endforelse
                    </tbody>
                </table>
                {{ $histories->links() }}
            </div>
        </div>
    </div>
@endsection
