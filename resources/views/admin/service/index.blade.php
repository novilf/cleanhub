@extends('layouts.admin')

@section('content')
<div class="container">
    <h5 class="fw-bold mb-4">Management Service</h5>
    <div class="d-flex justify-content-end mb-3">
        <div class="input-group" style="width: 200px;">
            <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
            <input type="text" id="search" class="form-control" placeholder="Search...">
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="fw-semibold">Your Service</h6>
        <!-- Tombol ini untuk memunculkan modal tambah service -->
        <button class="btn" style="background-color: #001F54; color: white;" data-bs-toggle="modal" data-bs-target="#addServiceModal">
            Add Service
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Service Name</th>
                    <th>Picture</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $index => $service)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $service['service_name'] ?? '-' }}</td>
                    <td>
                        @if(!empty($service['picture']))
                            <img src="{{ asset('img/' . $service['picture']) }}" alt="Icon" width="50" height="50">
                        @else
                            <span>-</span>
                        @endif
                    </td>
                    <td>
                        <!-- Tombol edit memanggil fungsi JS untuk buka modal dan isi form -->
                        <button class="btn btn-link text-warning me-2 p-0" 
                                onclick="editService({{ $service['id'] }}, '{{ addslashes($service['name']) }}')"
                                type="button" title="Edit Service">
                            <i class="bi bi-pencil-square"></i>
                        </button>

                        <form action="{{ route('services.destroy', $service['id']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Are you sure?')" title="Delete Service">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">No services found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Add Service -->
<div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content p-4">
      <h4 class="text-center fw-bold" style="color: #001F54;" id="addServiceModalLabel">Add Service</h4>
      <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label class="form-label fw-semibold">Service Name</label>
          <input type="text" name="service_name" class="form-control" required>
        </div>
        <div class="mb-3">
          <label class="form-label fw-semibold">Picture</label>
          <input type="file" name="picture" class="form-control" accept="image/*" required>
        </div>
        <div class="d-flex justify-content-center gap-2">
            <button type="submit" class="btn btn-primary">Add</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit Service -->
<div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content p-4">
      <h4 class="text-center fw-bold" style="color: #001F54;" id="editServiceModalLabel">Edit Service</h4>
      <form id="editServiceForm" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label class="form-label fw-semibold">Service Name</label>
          <input type="text" name="name" id="editServiceName" class="form-control" required>
        </div>
        <div class="d-flex justify-content-center gap-2">
            <button type="submit" class="btn btn-primary">Edit</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function editService(id, name) {
    document.getElementById('editServiceName').value = name;
    document.getElementById('editServiceForm').action = "{{ url('admin/services') }}/" + id;
    new bootstrap.Modal(document.getElementById('editServiceModal')).show();
  }
</script>

@endsection
