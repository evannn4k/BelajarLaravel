@extends('layout.admin-layout')

@section('content')
    <div class="container-fluid">
        <div class="my-3 mx-2">
            <div class="p-4 rounded shadow d-flex flex-column gap-4">

                <div class="">
                    <div class="">
                        <img src="{{ asset("storage/images/event/$event->image") }}" alt="" class="rounded-4 shadow"
                            style="max-width: 500px">
                    </div>
                    <div class="h3">{{ $event->title }}</div>
                    <table class="table table-borderless mt-2">
                        <tr>
                            <td class="p-0">Kategori</td>
                            <td class="p-0">:</td>
                            <td class="p-0">{{ $event->category->name }}</td>
                        </tr>
                        <tr>
                            <td class="p-0">Harga</td>
                            <td class="p-0">:</td>
                            <td class="p-0">Rp. {{ number_format($event->price) }}</td>
                        </tr>
                        <tr>
                            <td class="p-0">Kuota</td>
                            <td class="p-0">:</td>
                            <td class="p-0">{{ number_format($event->quota) }}</td>
                        </tr>
                        <tr>
                            <td class="p-0">Status</td>
                            <td class="p-0">:</td>
                            <td class="p-0">
                                @if ($event->status)
                                    <div class="badge text-bg-primary">Tersedia</div>
                                @else
                                    <div class="badge text-bg-danger">Tidak Tersedia</div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="p-0">Event diselenggarakan</td>
                            <td class="p-0">:</td>
                            <td class="p-0">{{ date('d-m-Y', strtotime($event->event_date)) }}</td>
                        </tr>
                        <tr>
                            <td class="p-0">Pendaftaran dimulai</td>
                            <td class="p-0">:</td>
                            <td class="p-0">{{ date('d-m-Y i-h', strtotime($event->reg_open_at)) }}</td>
                        </tr>
                        <tr>
                            <td class="p-0">Pendaftaran ditutup</td>
                            <td class="p-0">:</td>
                            <td class="p-0">{{ date('d-m-Y i-h', strtotime($event->reg_close_at)) }}</td>
                        </tr>
                    </table>
                    <div class="">{{ $event->description }}</div>
                </div>
                <div class="">
                    <a href="{{ route('admin.event.index') }}" class="btn btn-danger">Kembali</a>
                </div>
                <hr>
                <h3>Pendaftar</h3>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Event</th>
                            <th>Kupon</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Bukti Pembayaran</th>
                            <th>Created</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($event->registration->sortByDesc("created_at") as $registration)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $registration->user->name }}</td>
                                <td>{{ $registration->event->title }}</td>
                                <td>{{ $registration->coupon->code ?? '' }}</td>
                                <td>Rp. {{ number_format($registration->final_price) }}</td>
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
                                            Belum validasi
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if (!$registration->payment_proof)
                                        Belum dibayar
                                    @else
                                        <img src="{{ asset("storage/images/payment/$registration->payment_proof") }}"
                                            alt="" height="100px" data-bs-toggle="modal" data-bs-target="#modal"
                                            class="image">
                                    @endif
                                </td>
                                <td>{{ $registration->created_at->diffForHumans() }}</td>
                                <td>
                                    @if ($registration->status == 'pending' && $registration->payment_proof)
                                        <form action="{{ route('admin.event.register.approved', $registration->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('put')
                                            <button class="btn btn-primary btn-sm">Approved</button>
                                        </form>
                                        <form action="{{ route('admin.event.register.rejected', $registration->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('put')
                                            <button class="btn btn-danger btn-sm">Rejected</button>
                                        </form>
                                    @elseif(($registration->status == 'pending' && !$registration->payment_proof) || $registration->status == 'rejected')
                                        <form action="{{ route('admin.event.register.delete', $registration->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <td colspan="7" class="text-center">Tidak ada data</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="btn btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <img id="imageModal" src="" alt="" width="100%">
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll(".image").forEach(img => {
            img.addEventListener("click", function() {
                document.getElementById("imageModal").src = img.src
            })
        })
    </script>
@endsection
