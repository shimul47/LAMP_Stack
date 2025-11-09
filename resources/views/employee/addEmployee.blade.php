@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-container" style="max-width:600px">
        <h2 class="form-title">Add Employee</h2>

        <form action="{{ route('add.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label fs-5">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Mr. Example" required>
            </div>
            <div class="mb-3">
                <label class="form-label fs-5">Employee ID</label>
                <input type="text" class="form-control" name="eID" placeholder="Emp123..." required>
            </div>
            <div class="mb-3">
                <label class="form-label fs-5">Email</label>
                <input type="email" class="form-control" name="email" placeholder="email@gmail.com" required>
            </div>
            <div class="mb-3">
                <label class="form-label fs-5">Address</label>
                <input type="text" class="form-control" name="address" required>
            </div>
            <div class="mb-3">
                <label class="form-label fs-5">Phone</label>
                <input type="text" class="form-control" name="phone" required>
            </div>
            <div class="mb-3">
                <label class="form-label fs-5">Image</label>
                <input type="file" class="form-control" name="image" accept="image/*">
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Add Employee</button>
                <a href="{{ route('view') }}" class="btn btn-outline-secondary">Back</a>
            </div>
        </form>
    </div>
</div>
@endsection
