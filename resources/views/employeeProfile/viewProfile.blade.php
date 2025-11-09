@extends('layouts.app')

@section('content')
<div class="container mt-5" style="height:388px">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center mb-4">
                <h2 class="fw-bold">{{ $emp->full_name }}</h2>
                <p class="text-muted">Employee Profile</p>
            </div>

            <div class="profile-info p-4 border rounded bg-light card shadow">
                <p><strong>Bio:</strong> {{ $emp->bio ? $emp->bio:'No bio available' }}</p>
                <p><strong>Blood Group:</strong> {{ $emp->blood ?? 'Not specified' }}</p>  {{-- or condition this way --}}
            </div>

            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="{{ route('view') }}" class="btn btn-danger px-4">Back</a>
            </div>
        </div>
    </div>
</div>
@endsection
