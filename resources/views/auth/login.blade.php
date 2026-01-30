@extends('layout.main-layout')

@section('main')
    <div class="container">
        <div class="row vh-100 align-items-center">
            <div class="col-md-4 offset-md-4 p-4 rounded-4 shadow">
                <form action="{{ route('auth.verify') }}" method="POST">
                    @csrf
                    <div class="mb-3 text-center">
                        <h4>Login</h4>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            name="email">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                    </div>
                    {{-- <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div> --}}
                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                </form>
                <div class="py-2 text-center">Belum punya akun? sikahkan <a href="{{ route('register') }}">daftar</a></div>
            </div>
        </div>
    </div>
@endsection
