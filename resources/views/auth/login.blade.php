@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height:88vh;">
    <div class="card shadow-lg p-4 rounded-4" style="max-width: 420px; width:100%;">
        <div class="text-center mb-2">
            <h2 class="fw-bold text-success">Welcome Back</h2>
            <p class="text-muted">Please login to continue</p>
        </div>

        @if ($errors->has('login_error'))
            <div class="alert alert-danger text-center small">{{ $errors->first('login_error') }}</div>
        @endif
        
        <form action="{{ route('login.post') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="text" name="email" class="form-control form-control-md" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Password</label>
                <input type="password" name="password" class="form-control form-control-md" required>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('viewForget') }}" class="text-decoration-none small text-primary">
                    Forgot Password?
                </a>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-5">
                <button type="submit" class="btn btn-success btn-md px-4">Login</button>
                <a href="{{ route('signup') }}" class="btn btn-outline-success btn-md">Signup</a>
            </div>
        </form>
    </div>
</div>
@endsection
