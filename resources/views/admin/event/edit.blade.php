@extends('layout.admin-layout')

@section('content')
    <div class="container">
        <div class="py-5">

            <div class="row">
                <div class="col-md-6 offset-md-3 p-4 rounded-4 shadow-lg">
                    <form action="{{ route('admin.event.update', $event->slug) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="pb-3">
                            <h5>Mengedit event</h5>
                        </div>
                        <div class="pb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" id="title" name="title" class="form-control"
                                value="{{ $event->title }}">
                        </div>
                        <div class="pb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" rows="10" class="form-control">{{ $event->description }}</textarea>
                        </div>
                        <div class="pb-3">
                            <label for="category" class="form-label"></label>
                            <select name="category" id="category" class="form-select">
                                <option value="5K" {{ $event->category == '5K' ? 'selected' : '' }}>5K</option>
                                <option value="10K" {{ $event->category == '10K' ? 'selected' : '' }}>10K</option>
                                <option value="Marathon" {{ $event->category == 'Marathon' ? 'selected' : '' }}>Marathon
                                </option>
                            </select>
                        </div>
                        <div class="pb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" id="price" name="price" class="form-control"
                                value="{{ $event->price }}">
                        </div>
                        <div class="pb-3">
                            <label for="quota" class="form-label">Quota</label>
                            <input type="number" id="quota" name="quota" class="form-control"
                                value="{{ $event->quota }}">
                        </div>
                        <div class="pb-3">
                            <label for="status" class="form-label">Status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="true" value="1"
                                    {{ $event->status == true ? 'checked' : '' }}>
                                <label class="form-check-label" for="true">
                                    Aktif
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="false" value="0"
                                    {{ $event->status == false ? 'checked' : '' }}>
                                <label class="form-check-label" for="false">
                                    Tidak aktif
                                </label>
                            </div>
                        </div>
                        <div class="pb-3">
                            <a href="{{ route("admin.event.index") }}" class="btn btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
