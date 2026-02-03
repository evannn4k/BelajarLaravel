@extends('layout.user-layout')

@section('content')
    <div class="container">
        <div class="py-5">
            <div class="p-4 mb-5 d-flex justify-content-center">
                <div class="w-75">
                    <h3 class="text-center">Selamat datang Di Website EventLari</h3>
                    <p class="text-center">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Maxime, magnam dolorum!
                        Labore corporis animi necessitatibus molestias, itaque aperiam distinctio placeat repellat! Commodi
                        voluptatem mollitia fugiat praesentium tenetur unde saepe ea.</p>
                </div>
            </div>



            <div class="p-4 rounded-4 border shadow">
                <div class="mb-4">
                    <a href="{{ route("event") }}" class="h5 text-primary">Lihat Event Lainnya</a>
                </div>
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
                                        </div>
                                        <div class="">
                                            <a href="{{ route('detail', $event->slug) }}"
                                                class="btn btn-primary btn-sm">Lihat
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
    </div>
@endsection
