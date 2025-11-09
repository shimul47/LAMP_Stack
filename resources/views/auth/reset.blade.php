@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height:412px">
    <div class="card p-4" style="max-width:400px; width:100%">
        <h4 class="text-center mb-3">Reset Password</h4>
        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success w-100">Reset Password</button>
        </form>
    </div>
</div>
@endsection
