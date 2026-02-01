@extends('layout.admin-layout')

@section('content')
<div class="container-fluid">
    <div class="my-3 mx-2">
        <div class="p-4 rounded shadow d-flex flex-column gap-4">

            <div class="">
                <div class="h3">{{ $event->title }}</div>
                <table class="table table-borderless mt-2">
                    <tr>
                        <td class="p-0">Category</td>
                        <td class="p-0">:</td>
                        <td class="p-0">{{ $event->category }}</td>
                    </tr>
                    <tr>
                        <td class="p-0">Price</td>
                        <td class="p-0">:</td>
                        <td class="p-0">Rp. {{ number_format($event->price) }}</td>
                    </tr>
                    <tr>
                        <td class="p-0">Quota</td>
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
                </table>
                <div class="">{{ $event->description }}</div>
            </div>
            <div class="">
                <a href="{{ route("admin.event.index") }}" class="btn btn-danger">Kembali</a>
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
                    @forelse($event->registration as $registration)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $registration->user->name }}</td>
                        <td>{{ $registration->event->title }}</td>
                        <td>{{ $registration->coupon->code ?? "" }}</td>
                        <td>Rp. {{ number_format($registration->final_price) }}</td>
                        <td>
                            @if ($registration->status == "approved")
                            <div class="badge text-bg-primary">
                                {{ $registration->status }}
                            </div>
                            @else
                            <div class="badge text-bg-danger">
                                {{ $registration->status }}
                            </div>
                            @endif
                        </td>
                        <td>
                            @if (!$registration->payment_proof)
                            Belum dibayar
                            @else
                            <img src="{{ asset("storage/images/payment/$registration->payment_proof") }}" alt="" height="100px"
                                data-bs-toggle="modal"
                                data-bs-target="#modal"
                                class="image">
                            @endif
                        </td>
                        <td>{{ $registration->created_at->diffForHumans() }}</td>
                        <td>
                            @if ($registration->status == "pending")
                            <form action="{{ route("admin.event.register.approved", $registration->id) }}" method="POST">
                                @csrf
                                @method("put")
                                <button class="btn btn-primary btn-sm">Approved</button>
                            </form>
                            @endif
                            <form action="{{ route("admin.event.register.delete", $registration->id) }}" method="POST">
                                @csrf
                                @method("delete")
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
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