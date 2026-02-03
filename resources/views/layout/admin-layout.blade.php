@extends('layout.main-layout')

@section('main')
    <div class="d-flex vh-100">
        <aside class="overflow-auto flex-shrink-0 border-end" style="width:300px">
            <div class="p-3 d-flex flex-column">
                <div class="p-3 rounded-3 shadow-sm">
                    <h4>{{ Auth::guard('admin')->user()->name }}</h4>
                    <div>{{ Auth::guard('admin')->user()->email }}</div>
                </div>
                <div class="py-4 d-flex flex-column gap-2">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-light text-start">Dashboard</a>
                    <a href="{{ route('admin.event.index') }}" class="btn btn-light text-start">Event</a>
                    <a href="{{ route('admin.category-event.index') }}" class="btn btn-light text-start">Category</a>
                    <a href="{{ route('admin.coupon.index') }}" class="btn btn-light text-start">Coupon</a>
                    <a href="{{ route('admin.user.index') }}" class="btn btn-light text-start">User</a>
                </div>
            </div>
        </aside>

        <div class="flex-fill d-flex flex-column">
            <header class="px-3 py-2 border-bottom">
                <div class="d-flex justify-content-between">
                    <h5>Admin Dashboard</h5>
                    <a href="{{ route("logout")}}" class="btn btn-danger btn-sm">Logout</a>
                </div>
            </header>

            <div class="overflow-auto flex-fill">

                @yield('content')

            </div>
        </div>
    </div>
@endsection
