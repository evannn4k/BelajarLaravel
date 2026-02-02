@extends('layout.admin-layout')

@section('content')
    <div class="container">
        <div class="py-5">

            <div class="row">
                <div class="col-md-6 offset-md-3 p-4 rounded-4 shadow-lg">
                    <form action="{{ route('admin.event.update', $event->slug) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="pb-3">
                            <h5>Mengedit event</h5>
                        </div>
                        <div class="pb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" id="title" name="title"
                                class="form-control @error('title') is-invalid @enderror" value="{{ $event->title }}">
                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="pb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" rows="10"
                                class="form-control @error('description') is-invalid @enderror">{{ $event->description }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="pb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" id="category_id"
                                class="form-select @error('category_id') is-invalid @enderror">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $event->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="pb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" id="price" name="price"
                                class="form-control @error('price') is-invalid @enderror" value="{{ $event->price }}">
                            @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="pb-3">
                            <label for="quota" class="form-label">Quota</label>
                            <input type="number" id="quota" name="quota"
                                class="form-control @error('quota') is-invalid @enderror" value="{{ $event->quota }}">
                            @error('quota')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
                            <label for="event_date" class="form-label">Tanggal Event</label>
                            <input type="datetime-local" id="event_date" name="event_date"
                                class="form-control @error('event_date') is-invalid @enderror" value="{{ $event->event_date }}">
                            @error('event_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="pb-3">
                            <label for="reg_open_at" class="form-label">Dibuka</label>
                            <input type="datetime-local" id="reg_open_at" name="reg_open_at"
                                class="form-control @error('reg_open_at') is-invalid @enderror" value="{{ $event->reg_open_at }}">
                            @error('reg_open_at')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="pb-3">
                            <label for="reg_close_at" class="form-label">Ditutup</label>
                            <input type="datetime-local" id="reg_close_at" name="reg_close_at"
                                class="form-control @error('reg_close_at') is-invalid @enderror" value="{{ $event->reg_close_at }}">
                            @error('reg_close_at')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="pb-3">
                            <label for="image" class="form-label">Gambar</label>
                            <input type="file" id="image" name="image"
                                class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="pb-3">
                            <a href="{{ route('admin.event.index') }}" class="btn btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
