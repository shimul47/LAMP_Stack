@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center p-3 flex-wrap">
    <div>
        <h3 class="mb-0">Employee List</h3>
    </div>
    <div class="mt-2 mt-sm-0">
        <input 
            type="text" 
            id="employeeSearch" 
            class="form-control" 
            placeholder="Search employees..."
        >
    </div>
</div>
<div class="container mt-2">
    <div class="row g-4" id="employeeContainer">
        @foreach($employees as $e)
            <div class="col-md-4 employee-card-wrapper">
                <div class="card employee-card h-100 shadow-sm">
                    <img src="{{ asset("storage/".$e->image) }}" class="card-img-top" alt="{{ $e->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $e->name }}</h5>
                        <p class="card-text">
                            <strong>ID:</strong> {{ $e->eID }}<br>
                            <strong>Email:</strong> {{ $e->email }}<br>
                            <strong>Address:</strong> {{ $e->address }}<br>
                            <strong>Phone:</strong> {{ $e->phone }}
                        </p>
                        <div class="card-buttons gap-2">
                            @if(Auth::user()->name === 'Admin')
                                <a href="{{ route('edit', $e->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{ route('profile', $e->id) }}" class="btn btn-success btn-sm">Update Profile</a>
                                <a href="{{ route('delete', $e->id) }}" class="btn btn-danger btn-sm"
                                   onclick="return confirm('Are you sure?')">Delete</a>
                            @endif
                            <a href="{{ route('getProfile', $e->id) }}" class="btn btn-info btn-sm mt-1">View Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-4 justify-content-center">
        {{ $employees->links('pagination::bootstrap-5') }}
    </div>
</div>

{{-- Live Search Script --}}
<script>
$(document).ready(function(){
    $("#employeeSearch").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".employee-card-wrapper").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>

@endsection
