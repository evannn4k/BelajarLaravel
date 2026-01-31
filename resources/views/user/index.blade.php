@extends('layout.user-layout')

@section('content')
    <div class="container">
        <div class="py-5">
            <div class="row g-3">
                @foreach ($events as $event)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    {{ $event->title }}
                                </h4>
                                <div class="card-text">
                                    {{ Str::limit($event->description, 100) }}
                                </div>
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
                                        <td class="p-0">Yang mendaftar</td>
                                        <td class="p-0">:</td>
                                        <td class="p-0">{{ $event->totalResgist }}</td>
                                    </tr>
                                </table>
                                <a href="{{ route("detail", $event->slug) }}" class="btn btn-primary btn-sm">Lihat Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
