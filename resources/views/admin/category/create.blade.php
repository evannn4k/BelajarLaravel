@extends('layout.admin-layout')

@section('content')
    <div class="container">
        <div class="py-5">
            <div class="row">
                <div class="col-md-6 offset-md-3 p-4 rounded-4 shadow-lg">
                    <form action="{{ route('admin.category-event.store') }}" method="POST">
                        @csrf
                        <div class="pb-3">
                            <h5>Tambah kategori baru</h5>
                        </div>
                        <div class="pb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" id="name" name="name"
                                class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="pb-3">
                            <a href="{{ route('admin.category-event.index') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-disk"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
