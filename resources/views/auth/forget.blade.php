@extends('layouts.app')

@section('content')
<div class="container d-flex flex-column justify-content-center align-items-center" style="height:80vh;">
    <div class="card shadow-lg p-4 rounded-4" style="max-width: 420px; width:100%;">
        <h3 class="text-center mb-3">Forgot Password</h3>
        <form action="{{ route('forget') }}" method="POST">
            @csrf
            <label for="email" class="form-label fw-semibold">Enter your email</label>
            <input type="email" name="email" class="form-control mb-3" required>

            <button type="submit" class="btn btn-success w-100">Send Reset Link</button>
            <div class="text-center mt-3">
                <a href="{{ route('login') }}" class="small text-decoration-none">Back to login</a>
            </div>
        </form>
    </div>
</div>
@endsection
