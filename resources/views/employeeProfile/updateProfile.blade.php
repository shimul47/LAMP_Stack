@extends('layouts.app')

@section('content')
<div class="container mt-5 col-md-5">
    <h3 class="mb-4">Update Profile</h3>

    <form action="{{ route('updateProfile.post', $e) }}" method="POST" class="p-4 gg border rounded shadow">
        @csrf @method('PUT')
        <div class="mb-3">
            <label for="full_name" class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea name="bio" class="form-control" rows="3"></textarea>
        </div>
        <div class="mb-3 col-4 col-md-4">
            <label for="blood" class="form-label">Blood Group</label>
            <select name="blood" class="form-select" required>
                <option value="">Select</option>
                <option value="A+" {{ old('blood') == 'A+' ? 'selected' : '' }}>A+</option>
                <option value="A-" {{ old('blood') == 'A-' ? 'selected' : '' }}>A-</option>
                <option value="B+" {{ old('blood') == 'B+' ? 'selected' : '' }}>B+</option>
                <option value="B-" {{ old('blood') == 'B-' ? 'selected' : '' }}>B-</option>
                <option value="O+" {{ old('blood') == 'O+' ? 'selected' : '' }}>O+</option>
                <option value="O-" {{ old('blood') == 'O-' ? 'selected' : '' }}>O-</option>
                <option value="AB+" {{ old('blood') == 'AB+' ? 'selected' : '' }}>AB+</option>
                <option value="AB-" {{ old('blood') == 'AB-' ? 'selected' : '' }}>AB-</option>
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ route('view') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
