@extends('layout.main-layout')

@section('main')
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="{{ route("index") }}">EventLari</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="{{  route("index") }}">Berada</a>
                    @if (Auth::guard("user")->check())
                    <a class="nav-link" href="{{ route("history") }}">History</a>
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
