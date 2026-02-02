@extends('layout.user-layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="my-5">
                    <div class="p-4 rounded shadow d-flex flex-column gap-4">

                        <div class="">
                            <div class="rounded-3 mb-3"
                                style="height: 300px; width: 100%; background-image: url('{{ asset("storage/images/event/$event->image") }}'); background-size: cover; background-position: center;">
                            </div>
                            {{-- <img src="{{ asset("storage/images/event/$event->image") }}" alt=""
                                    class="rounded-4 shadow img-fluid w-100 mb-4"> --}}
                            <div class="h3">{{ $event->title }}</div>
                            <table class="table table-borderless mt-2">
                                <tr>
                                    <td class="p-0">Category</td>
                                    <td class="p-0">:</td>
                                    <td class="p-0">{{ $event->category->name }}</td>
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
                        <hr>
                        @if (!Auth::guard('user')->check())
                            <div class="">Harap <a href="{{ route('login') }}">login</a> terlebih dahulu</div>
                        @else
                            @if ($event->reg_open_at <= now() && $event->reg_close_at >= now())
                                @if ($event->quota <= 0)
                                    <div class="">
                                        Tiket sudah habis
                                    </div>
                                @else
                                    <div class="">
                                        <form action="{{ route('regist.event') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                                            <div class="row g-3">
                                                <div class="col-md-12">
                                                    <label for="code" class="form-label">Coupon</label>
                                                    <input type="text" class="form-control" name="code"
                                                        id="code">
                                                </div>
                                                <div class="col-md-12">
                                                    <a href="{{ route('index') }}" class="btn btn-danger">Kembali</a>
                                                    <button class="btn btn-primary">Daftar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            @else
                                <div class="">
                                    Belum masuk tanggal pendaftaran
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
