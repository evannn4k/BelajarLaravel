@extends('layout.admin-layout')

@section('content')
    <div class="p-3">
        <div class="container">
            <div class="py-5">
                <div class="pb-3">
                    <a href="{{ route('admin.coupon.create') }}" class="btn btn-primary">Create coupon</a>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Code</th>
                            <th>Discount Type</th>
                            <th>Discount Value</th>
                            <th>Is Active</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($coupons as $coupon)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $coupon->code }}</td>
                                <td>{{ $coupon->discount_type }}</td>
                                <td>{{ $coupon->discount_value }}</td>
                                <td>{{ $coupon->is_active }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.coupon.edit', $coupon->id) }}"
                                            class="btn btn-success btn-sm">edit</a>
                                        {{-- <a href="{{ route("coupon.edit", $coupon->slug) }}" class="btn btn-danger btn-sm">delete</a> --}}
                                        <form action="{{ route('admin.coupon.delete', $coupon->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
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
    </div>
@endsection
