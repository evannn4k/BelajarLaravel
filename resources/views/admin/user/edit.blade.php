@extends('layout.admin-layout')

@section('content')
<div class="container">
    <div class="py-5">

        <div class="row">
            <div class="col-md-6 offset-md-3 p-4 rounded-4 shadow-lg">
                <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
                    @csrf
                    @method("put")
                    <div class="pb-3">
                        <h5>Tambah user baru</h5>
                    </div>
                    <div class="pb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control @error("name") is-invalid @enderror" value="{{ $user->name }}">
                        @error("name")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="pb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control @error("email") is-invalid @enderror" value="{{ $user->email }}">
                        @error("email")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="pb-3">
                        <label for="password" class="form-label">Ganti Password</label>
                        <input type="password" id="password" name="password" class="form-control @error("password") is-invalid @enderror">
                        @error("password")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="pb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error("password_confirmation") is-invalid @enderror">
                        @error("password_confirmation")
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    
                    <div class="pb-3">
                        <label for="role" class="form-label">Role</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="true" value="admin" {{ ($user->role == "admin") ? "checked" : "" }}>
                            <label class="form-check-label" for="true">
                                Admin
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="role" id="false" value="user" {{ ($user->role == "user") ? "checked" : "" }}>
                            <label class="form-check-label" for="false">
                                User
                            </label>
                        </div>
                    </div>
                    <div class="pb-3">
                        <a href="{{ route("admin.user.index") }}" class="btn btn-danger">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection