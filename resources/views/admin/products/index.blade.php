@extends('layouts.admin')

@section('content')
<div class="container">
    <h5 class="fw-bold mb-4">Management Products</h5>
    <div class="d-flex justify-content-end mb-3">
    <div class="input-group" style="width: 200px;">
        <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
        <input type="text" id="search" class="form-control" placeholder="Search...">
    </div>
</div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-semibold">Your Products</h6>
        <a href="#" class="btn" style="background-color: #001F54; color: white;" data-bs-toggle="modal" data-bs-target="#modalAdd">Add Products</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Products Name</th>
                    <th>Picture</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $i => $product)
                    <tr>
                        <td>{{ $i + 1 }}.</td>
                        <td class="fw-semibold">{{ $product['product_name'] }}</td>
                        <td><img src="{{ asset('img/' . $product['picture']) }}" alt="pic" width="50" height="50"></td>
                        <td class="fw-bold">{{ number_format($product['price']) }}</td>
                        <td>
                            <a href="#" class="text-warning me-2" onclick="editProduct({{ $product['id'] }}, '{{ $product['product_name'] }}', {{ $product['price'] }})">
    <i class="bi bi-pencil-square"></i>
</a>

                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure to delete this product?')">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-link text-danger p-0 m-0" style="text-decoration: none;">
                              <i class="bi bi-trash-fill"></i>
                          </button>
                        </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No products found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Add Product -->
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-4">
      <div class="modal-header border-0">
        <h4 class="w-100 text-center fw-bold" style="color: #001F54;">Add Product</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label fw-bold text-primary">Product Name</label>
            <input type="text" name="product_name" class="form-control" placeholder="Enter your product name" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold text-primary">Price</label>
            <input type="number" name="price" class="form-control" placeholder="Enter your product price" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold text-primary">Picture</label>
            <input type="file" name="picture" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
            <button type="submit" class="btn btn-primary ms-2">Add</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit Product -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-4">
      <div class="modal-header border-0">
        <h4 class="w-100 text-center fw-bold" style="color: #001F54;">Edit Product</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editForm" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          <div class="mb-3">
            <label class="fw-bold text-primary">Product Name</label>
            <input type="text" name="name" id="editName" class="form-control" placeholder="Enter product name" required>
          </div>
          <div class="mb-3">
            <label class="fw-bold text-primary">Price</label>
            <input type="number" name="price" id="editPrice" class="form-control" placeholder="Enter product price" required>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btn-primary ms-2">Edit</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection
@section('scripts')
<script>
  function editProduct(id, name, price) {
    // Isi form edit
    document.getElementById('editName').value = name;
    document.getElementById('editPrice').value = price;

    // Atur action form edit ke URL yang sesuai
    document.getElementById('editForm').action = `/products/${id}`;

    // Tampilkan modal edit
    var modal = new bootstrap.Modal(document.getElementById('modalEdit'));
    modal.show();
  }
</script>
@endsection
