@extends('layout.admin-layout')

@section('content')
<div class="container">
    <div class="py-5">

        <div class="row">
            <div class="col-md-6 offset-md-3 p-4 rounded-4 shadow-lg">
                <form action="{{ route('admin.event.store') }}" method="POST">
                    @csrf
                    <div class="pb-3">
                        <h5>Tambah event baru</h5>
                    </div>
                    <div class="pb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" id="title" name="title" class="form-control @error("title") is-invalid @enderror">
                        @error("title")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="pb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" rows="10" class="form-control @error("description") is-invalid @enderror"></textarea>
                        @error("description")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="pb-3">
                        <label for="category" class="form-label">Category</label>
                        <select name="category" id="category" class="form-select @error("category") is-invalid @enderror">
                            <option value="5K">5K</option>
                            <option value="10K">10K</option>
                            <option value="Marathon">Marathon</option>
                        </select>
                        @error("category")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="pb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" id="price" name="price" class="form-control @error("price") is-invalid @enderror">
                        @error("price")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="pb-3">
                        <label for="quota" class="form-label">Quota</label>
                        <input type="number" id="quota" name="quota" class="form-control @error("quota") is-invalid @enderror">
                        @error("quota")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="pb-3">
                        <label for="status" class="form-label">Status</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="true" value="1" checked>
                            <label class="form-check-label" for="true">
                                Aktif
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="status" id="false" value="0">
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