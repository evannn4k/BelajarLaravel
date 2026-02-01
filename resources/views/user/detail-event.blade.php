@extends('layout.user-layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="my-5">
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
                        <hr>
                        @if (!Auth::guard('user')->check())
                            <div class="">Harap <a href="{{ route('login') }}">login</a> terlebih dahulu</div>
                        @else
                            @if ($event->quota <= 0)
                                <div class="">
                                    Event sudah habis
                                </div>
                            @else
                                <div class="">
                                    <form action="{{ route('regist.event') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label for="code" class="form-label">Coupon</label>
                                                <input type="text" class="form-control" name="code" id="code">
                                            </div>
                                            <div class="col-md-12">
                                                <a href="{{ route("index") }}" class="btn btn-danger">Kembali</a>
                                                <button class="btn btn-primary">Daftar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
