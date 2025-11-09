@extends("layouts.app")

@section('content')
<div class="container mt-4">
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="image" class="form-label">Product Image</label>
            <input type="file" name="image" id="image" class="form-control">
            @error('image') <p class="text-danger small">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Enter product name">
            @error('product_name') <p class="text-danger small">{{ $message }}</p> @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" id="price" class="form-control" placeholder="Enter price" step="0.01">
            @error('price') <p class="text-danger small">{{ $message }}</p> @enderror
        
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Add Product</button>
                <a href="{{ route('products.index') }}" class="btn btn-outline-dark">Back</a>
            </div>
        
    </form>
</div>
@endsection
