@extends('layout.admin-layout')

@section('content')
<div class="p-3">
    <div class="container">
        <div class="pb-3">
            <a href="{{ route('admin.coupon.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah kupon</a>
        </div>
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode</th>
                    <th>Tipe Diskon</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Dibuka</th>
                    <th>Ditutup</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($coupons as $coupon)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $coupon->code }}</td>
                    <td>{{ $coupon->discount_type }}</td>
                    <td>
                        @if ($coupon->discount_type == "flat")
                        Rp. {{ number_format($coupon->discount_value) }}
                        @else
                        {{ number_format($coupon->discount_value) }}%
                        @endif
                    </td>
                    <td>{{ $coupon->is_active }}</td>
                    <td>{{ date('d-m-Y i-h', strtotime($coupon->open_at)) }}</td>
                    <td>{{ date('d-m-Y i-h', strtotime($coupon->closed_at)) }}</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.coupon.edit', $coupon->id) }}"
                                class="btn btn-success btn-sm"><i class="fa fa-pen-to-square"></i></a>
                            <form action="{{ route('admin.coupon.delete', $coupon->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection