@extends('layout.admin-layout')

@section('content')
    <div class="container">
        <div class="py-5">
            <div class="row">
                <div class="col-md-6 offset-md-3 p-4 rounded-4 shadow-lg">
                    <form action="{{ route('admin.coupon.store') }}" method="POST">
                        @csrf
                        <div class="pb-3">
                            <h5>Tambah coupon baru</h5>
                        </div>
                        <div class="pb-3">
                            <label for="code" class="form-label">Kode</label>
                            <input type="text" id="code" name="code"
                                class="form-control @error('code') is-invalid @enderror">
                            @error('code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="pb-3">
                            <label for="discount_type" class="form-label">Tipe diskon</label>
                            <select name="discount_type" id="discount_type"
                                class="form-select @error('discount_type') is-invalid @enderror">
                                <option value="flat">flat</option>
                                <option value="precent">precent</option>
                            </select>
                            @error('discount_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="pb-3">
                            <label for="discount_value" class="form-label">Jumlah</label>
                            <input type="number" id="discount_value" name="discount_value"
                                class="form-control @error('discount_value') is-invalid @enderror">
                            @error('discount_value')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="pb-3">
                            <label for="is_active" class="form-label">Status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" checked name="is_active" id="true"
                                    value="1">
                                <label class="form-check-label" for="true">
                                    Aktif
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" id="false"
                                    value="0">
                                <label class="form-check-label" for="false">
                                    Tidak aktif
                                </label>
                            </div>
                        </div>
                        <div class="pb-3">
                            <label for="open_at" class="form-label">Dibuka</label>
                            <input type="datetime-local" id="open_at" name="open_at"
                                class="form-control @error('open_at') is-invalid @enderror">
                            @error('open_at')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="pb-3">
                            <label for="closed_at" class="form-label">Ditutup</label>
                            <input type="datetime-local" id="closed_at" name="closed_at"
                                class="form-control @error('closed_at') is-invalid @enderror">
                            @error('closed_at')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="pb-3">
                            <a href="{{ route('admin.coupon.index') }}" class="btn btn-danger"><i
                                    class="fa fa-arrow-left"></i> Kembali</a>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-disk"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
