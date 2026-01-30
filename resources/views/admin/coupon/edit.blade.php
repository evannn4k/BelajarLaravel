@extends('layout.admin-layout')

@section('content')

    <div class="container">
        <div class="py-5">
            <div class="row">
                <div class="col-md-6 offset-md-3 p-4 rounded-4 shadow-lg">
                    <form action="{{ route('admin.coupon.update', $coupon->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="pb-3">
                            <h5>Tambah coupon baru</h5>
                        </div>
                        <div class="pb-3">
                            <label for="code" class="form-label">code</label>
                            <input type="text" id="code" name="code" class="form-control"
                                value="{{ $coupon->code }}">
                        </div>
                        <div class="pb-3">
                            <label for="discount_type" class="form-label">Discount Type</label>
                            <select name="discount_type" id="discount_type" class="form-select">
                                <option value="flat" {{ $coupon->discount_type == 'flat' ? 'selected' : '' }}>flat
                                </option>
                                <option value="precent" {{ $coupon->discount_type == 'precent' ? 'selected' : '' }}>
                                    precent</option>
                            </select>
                        </div>
                        <div class="pb-3">
                            <label for="discount_value" class="form-label">discount value</label>
                            <input type="number" id="discount_value" name="discount_value" class="form-control"
                                value={{ $coupon->discount_value }}>
                        </div>
                        <div class="pb-3">
                            <label for="is_active" class="form-label">Status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" id="true"
                                    value="1" {{ $coupon->is_active == true ? 'checked' : '' }}>
                                <label class="form-check-label" for="true">
                                    Aktif
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_active" id="false"
                                    value="0" {{ $coupon->is_active == false ? 'checked' : '' }}>
                                <label class="form-check-label" for="false">
                                    Tidak aktif
                                </label>
                            </div>
                        </div>
                        <div class="pb-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
