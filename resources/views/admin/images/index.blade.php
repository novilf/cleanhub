@extends('layouts.admin')

@section('content')

<style>
.btn-custom-primary {
    background-color: #001F54 !important;
    border-color: #001F54 !important;
    color: white !important;
}

.btn-custom-primary:hover,
.btn-custom-primary:focus,
.btn-custom-primary:active {
    background-color: #001A4B !important;
    border-color: #001A4B !important;
    color: white !important;
    box-shadow: none !important;
}
</style>

<div class="container">
    <!-- Deskripsi Pasar -->
    <div class="card shadow-sm mb-4 p-4">
        <h5 class="fw-bold mb-3">Management Desc</h5>
        <h6 class="fw-semibold mb-2">Your Market Describe</h6>
        <div class="bg-primary bg-opacity-25 p-3 rounded mb-3" id="marketDescription">
            {{$description}}
        </div>
        <button class="btn btn-custom-primary fw-semibold" onclick="openEditDescModal()">
            Update
        </button>
    </div>

    <!-- Manajemen Gambar -->
    <div class="card shadow-sm p-4">
        <h5 class="fw-bold mb-3">Management Image</h5>
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 60%;">Image</th>
                        <th style="width: 20%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach($images as $index => $img)
                  <tr>
                      <td>{{ $index + 1 }}.</td>
                      <td>
                          <img src="{{ asset('img/' . $img->image) }}" alt="image{{ $index + 1 }}" class="img-fluid rounded" style="max-height: 130px;">
                      </td>
                      <td>
                          <form action="{{ route('dashboard.images.destroy', $img->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger fw-semibold">Delete</button>
                          </form>
                      </td>
                  </tr>
                  @endforeach
              </tbody>
              
            </table>
        </div>
        <button class="btn btn-custom-primary mt-3 fw-semibold" data-bs-toggle="modal" data-bs-target="#addImageModal">
            Add Image
        </button>
    </div>
</div>



<!-- Modal Edit Description -->
<div class="modal fade" id="editDescModal" tabindex="-1" aria-labelledby="editDescModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content p-4">
      <h4 class="text-center fw-bold text-primary" id="editDescModalLabel">Edit Description</h4>
      <form id="editDescForm" method="POST" action="{{ route('dashboard.description.update') }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="descText" class="form-label fw-semibold">Description</label>
          <textarea name="description" id="descText" class="form-control" rows="4" required></textarea>
        </div>
        <div class="d-flex justify-content-center gap-2">
            <button type="submit" class="btn btn-custom-primary">Edit</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Add Image -->
<div class="modal fade" id="addImageModal" tabindex="-1" aria-labelledby="addImageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content p-4">
      <h4 class="text-center fw-bold text-primary" id="addImageModalLabel">Add Image</h4>
      <form action="{{ route('dashboard.images.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="imageUpload" class="form-label fw-semibold">Upload Picture</label>
          <input type="file" name="image" id="imageUpload" class="form-control" accept="image/*" required>
        </div>
        <div class="d-flex justify-content-center gap-2">
            <button type="submit" class="btn btn-custom-primary">Add</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function openEditDescModal() {
    const currentDesc = document.getElementById('marketDescription').innerText.trim();
    document.getElementById('descText').value = currentDesc;
    new bootstrap.Modal(document.getElementById('editDescModal')).show();
  }
</script>

@endsection
