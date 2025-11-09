@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center">
    <div class="card shadow-lg p-4 rounded-4" style="width:100%;max-width:400px;">
        <h3 class="text-center text-success mb-4">Edit Employee</h3>
        <form action="{{ route('edit.post', $e->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="text-center mb-3">
                <img src="{{ asset("storage/".$e->image) }}" class="img-thumbnail mb-2" style="width:120px;height:120px;object-fit:cover;border-radius:50%;border:3px solid lightgreen">
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Change Image</label>
                <input type="file" class="form-control" name="image" accept="image/*">
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Name</label>
                <input type="text" class="form-control" name="name" value="{{ old('name', $e->name) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email', $e->email) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Address</label>
                <input type="text" class="form-control" name="address" value="{{ old('address', $e->address) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Phone</label>
                <input type="text" class="form-control" name="phone" value="{{ old('phone', $e->phone) }}" required>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="{{ route('view') }}" class="btn btn-outline-secondary px-4">Back</a>
                <button type="submit" class="btn btn-success px-4">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
