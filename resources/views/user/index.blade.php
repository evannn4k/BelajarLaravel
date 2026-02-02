@extends('layout.user-layout')

@section('content')
    <div class="container">
        <div class="py-5">
            <div class="row g-3">
                @forelse ($events as $event)
                    <div class="col-md-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex h-100 flex-column justify-content-between align-items-between">
                                    <div class="">
                                        @if (!$event->image)
                                            <div class="rounded-3 mb-3"
                                                style="height: 300px; width: 100%; background-image: url('{{ asset('images/default.jpg') }}'); background-size: cover; background-position: center;">
                                            </div>
                                        @else
                                            <div class="rounded-3 mb-3"
                                                style="height: 300px; width: 100%; background-image: url('{{ asset("storage/images/event/$event->image") }}'); background-size: cover; background-position: center;">
                                            </div>
                                        @endif
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
                                                <td class="p-0">Yang mendaftar</td>
                                                <td class="p-0">:</td>
                                                <td class="p-0">{{ $event->totalResgist }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="">
                                        <a href="{{ route('detail', $event->slug) }}" class="btn btn-primary btn-sm">Lihat
                                            Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty

                    <div class="text-center">Belum ada event yang tersedia</div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
