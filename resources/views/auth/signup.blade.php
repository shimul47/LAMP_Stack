@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height:88vh;">
    <div class="card shadow p-4 rounded-4" style="width:100%;max-width:420px;">
        <h3 class="text-center mb-3 text-success">Signup Now</h3>

        <form method="POST" action="{{ route('signup.post') }}">
            @csrf
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                @error('name') <p class="text-danger small">{{ $message }}</p> @enderror
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                @error('email') <p class="text-danger small">{{ $message }}</p> @enderror
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                @error('password') <p class="text-danger small">{{ $message }}</p> @enderror
            </div>

            <div class="mb-3">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4">
                <button type="submit" class="btn btn-success px-4">Sign Up</button>
                <a href="{{ route('login') }}" class="btn btn-outline-success">Login</a>
            </div>
        </form>
    </div>
</div>
@endsection
