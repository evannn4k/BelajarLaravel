@extends('layout.user-layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="my-5">
                <div class="p-4 rounded shadow d-flex flex-column gap-4">

                    <h3 class="text-center">
                        Harap mengirimkan bukti pembayaran
                    </h3>

                    <table class="table table-borderless">
                        <tr>
                            <td class="w-50">Event</td>
                            <td>:</td>
                            <td>{{ $registration->event->title }}</td>
                        </tr>
                        <tr>
                            <td class="w-50">Pendaftar</td>
                            <td>:</td>
                            <td>{{ $registration->user->name }}</td>
                        </tr>
                        <tr>
                            <td class="w-50">Harga awal</td>
                            <td>:</td>
                            <td>Rp. {{ number_format($registration->event->price) }}</td>
                        </tr>
                        <tr>
                            <td class="w-50">Kupon</td>
                            <td>:</td>
                            <td>{{ $registration->coupon->code ?? "" }}</td>
                        </tr>
                        <tr>
                            <td class="w-50">Potongan kupon</td>
                            <td>:</td>
                            <td>
                                @if ($registration->coupon)
                                @if ($registration->coupon->discount_type == "flat")
                                Rp. {{ number_format($registration->coupon->discount_value) }}
                                @else
                                {{ $registration->coupon->discount_value }}%
                                @endif
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="w-50">Harga akhir</td>
                            <td>:</td>
                            <td>Rp. {{ number_format($registration->final_price) }}</td>
                        </tr>
                    </table>
                    @if (!Auth::guard('user')->check())
                    <div class="">Harap <a href="{{ route('login') }}">login</a> terlebih dahulu</div>
                    @else
                    <form action="{{ route("payment.proof", $registration->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("put")
                        <div class="mb-3">
                            <label for="payment_proof" class="form-label">Bukti pembayaran</label>
                            <input type="file" name="payment_proof" id="payment_proof" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection