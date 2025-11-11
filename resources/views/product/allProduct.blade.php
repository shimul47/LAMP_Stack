@extends('layouts.app')
@section('content')
<div class="container">

    <div class="row g-3 mb-3">
        <div class="col-12 col-sm-3 col-md-4">
            <div class="card h-100 shadow-lg effect">
                <div class="card-body text-center">
                    <h5 class="card-title fs-4">Total Product</h5>
                    <p id="totalCount" class="fw-bold fs-4">{{$total}}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-3 col-md-4">
            <div class="card h-100 shadow-lg effect">
                <div class="card-body text-center">
                    <h5 class="card-title fs-4">Currently Active</h5>
                    <p id="activeCount" class="fw-bold fs-4">{{$active}}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card h-100 shadow-lg effect">
                <div class="card-body text-center">
                    <h5 class="card-title text-danger fs-4">Inactive</h5>
                    <p id="inactiveCount" class="fw-bold fs-4 text-danger">{{$inactive}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-lg" >
        <div class="card-header d-flex justify-content-between align-items-center no_effect">
            <h5 class="mb-0">All Products</h5>
            @if(Auth::user()->name === "Admin")
                <a href="{{ route('products.create') }}" class="btn btn-light btn-sm">
                    <i class="fa-solid fa-plus"></i>
                </a>
            @endif
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 serverview">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th class="border">Image</th>
                            <th class="border">Product Name</th>
                            <th class="border">Price</th>
                            <th class="border">Status</th>
                            @if(Auth::user()->name === "Admin")
                                <th class="border">Operations</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="text-center" id="row-{{ $product->id }}">
                                <td class="border">
                                    <img id="img_{{ $product->id }}" src="{{ $product->image ? asset('storage/'.$product->image) : asset('storage/products/default.jpg') }}" 
                                         class="rounded-circle" width="40" height="40" style="object-fit: cover;" >
                                </td>
                                <td id="name_{{ $product->id }}" class="border">{{ $product->product_name }}</td>
                                <td id="price_{{ $product->id }}" class="border">{{ $product->price }}৳</td>
                                <td class="border">
                                    <span class="badge {{ $product->status === 'active' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($product->status) }}
                                    </span>
                                </td>
                                @if(Auth::user()->name === "Admin")
                                    <td class="border">
                                        {{-- Toggle --}}
                                        <button type="button"   class="btn btn-sm"
                                        onclick="if (confirm('Are you sure?')){ 
                                            toggleStatus({{ $product->id }}, this); 
                                        }">
                                            @if($product->status === 'active')
                                                <i class="fa-solid fa-toggle-on text-success"></i>
                                            @else
                                                <i class="fa-solid fa-toggle-off text-secondary"></i>
                                            @endif
                                        </button>

                                        {{-- Edit --}}
                                        <button type="button"
                                        class="btn btn-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#edit"  
                                        onclick="openEditModal({{ $product->id }})"><i class="fa-regular fa-pen-to-square"></i></button>

                                        {{-- Delete --}}
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this product?')">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4 justify-content-center">
        {{ $products->links('pagination::bootstrap-5') }}
    </div>
</div>

{{-- edit Popup --}}

<div class="modal fade" id="edit" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow-lg">

      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold text-success">Edit Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body pt-0">
        <form id="editForm" enctype="multipart/form-data">

            <input type="hidden" id="edit_id">
            <div class="text-center mb-3">
                <img id="edit_preview_img" 
                     src="{{ asset('storage/'.$product->image)}}" 
                     class="img-thumbnail" 
                     style="width:120px;height:120px;object-fit:cover;border-radius:50%;border:3px solid lightgreen">
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Change Image</label>
                <input type="file" class="form-control" name="image" id="edit_image" accept="image/*">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Product Name</label>           
                <input type="text" name="product_name" id="edit_name" class="form-control" value="{{ old('product_name', $product->product_name) }}" required>
                @error('product_name') <p class="text-danger small">{{ $message }}</p> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Price</label>
                <input type="number" name="price" id="edit_price" class="form-control" value="{{ old('price', $product->price) }}"required>
                @error('price') <p class="text-danger small">{{ $message }}</p> @enderror
            </div>
        </form>
      </div>
        <div class="modal-footer border-0">
            <button class="btn btn-secondary btn-sm px-4" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-success btn-sm px-4" onclick="saveEdit()">Save</button>
        </div>
    </div>
  </div>
</div>

<script>
//this is for status bar
function updateCounts(total, active, inactive) {
    $("#totalCount").text(total);
    $("#activeCount").text(active);
    $("#inactiveCount").text(inactive);
}
//for toggle_button
function toggleStatus(id, btn) {
    $.ajax({
        url: `/products/${id}`,
        type: "PUT",
        data: { _token: "{{ csrf_token() }}", toggle_status: true },
        success: function(res) {
            let icon = $(btn).find("i");
            let badge = $(btn).closest("tr").find("td:eq(3) span");

            if (res.status === "active") {
                icon.removeClass("fa-toggle-off text-secondary").addClass("fa-toggle-on text-success");
                badge.removeClass("bg-danger").addClass("bg-success").text("Active");
            } else {
                icon.removeClass("fa-toggle-on text-success").addClass("fa-toggle-off text-secondary");
                badge.removeClass("bg-success").addClass("bg-danger").text("Inactive");
            }
            updateCounts(res.count.total, res.count.active, res.count.inactive);
        },
        error: () => alert("Failed to toggle status.")
    });
}
//open edit form
function openEditModal(id) {
    let name = document.getElementById("name_" + id).innerText;
    let price = document.getElementById("price_" + id).innerText.replace("৳", "");
    let image = document.getElementById("img_" + id).src;
    //fetching dynamicalyy
    document.getElementById("edit_id").value = id;
    document.getElementById("edit_name").value = name;
    document.getElementById("edit_price").value = price;
    document.getElementById("edit_preview_img").src = image;
}

function saveEdit() {
    let id = document.getElementById("edit_id").value;
    let form = document.getElementById("editForm");
    let formData = new FormData(form);
    formData.append("_token", "{{ csrf_token() }}");
    formData.append("_method","PUT");

    $.ajax({
        url: `/products/${id}`,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
    
        success: function(res) {
            if (!res.success) {
                alert("Update failed!");
                return;
            }

            let modal = bootstrap.Modal.getInstance(document.getElementById("edit"));
            modal.hide();

            $("#name_" + id).text(res.data.product_name);
            $("#price_" + id).text(res.data.price + "৳");
            $("#img_" + id).attr("src", res.data.image ? "/storage/" + res.data.image : "/storage/products/default.jpg");
        },

        error: function() {
            alert("Failed to update product!");
        }
    });
}
</script>
@endsection