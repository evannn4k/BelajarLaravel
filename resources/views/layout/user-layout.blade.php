@extends('layout.main-layout')

@section('main')
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="{{ route("index") }}">EventLari</a>
            <div class="navbar">
                <div class="navbar-nav">
                    <a class="nav-link" href="{{  route("index") }}">Beranda</a>
                    <a class="nav-link" href="{{  route("event") }}">Event</a>
                    @if (Auth::guard("user")->check())
                    <a class="nav-link" href="{{ route("history") }}">History</a>
                    <a class="nav-link" href="{{ route("profil.index") }}">Profil</a>
                    @endif
                </div>
            </div>
            <div class="ms-auto d-flex align-items-center gap-3">
                @if (Auth::guard('user')->check())
                    <div class="fw-semibold">Hi, {{ Auth::guard("user")->user()->name }} 👋👋👋</div>
                    <a href="{{ route('logout') }}" class="btn btn-danger btn-sm">Logout</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login</a>
                @endif
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
@endsection
