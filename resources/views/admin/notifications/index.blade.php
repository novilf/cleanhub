@extends('layouts.admin')

@section('content')
<div class="container">
  <h4 class="fw-bold mb-3">Notifications</h4>

  @if(count($notifications) > 0)
  <div class="card">
    <div class="card-body">
      <h5 class="fw-bold mb-3">New Orders</h5>
      <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
          <thead style="background-color: #1c3f94; color: white;">
            <tr>
              <th>No</th>
              <th>Date</th>
              <th>Username</th>
              <th>Price</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($notifications as $index => $notif)
            <tr class="{{ $index % 2 == 0 ? 'table-light' : 'table-primary' }}">
              <td>{{ $index + 1 }}.</td>
              <td class="fw-bold">{{ $notif['date'] }}</td>
              <td>{{ $notif['username'] }}</td>
              <td>Rp{{ number_format($notif['price'], 0, ',', '.') }}</td>
              <td>
                <!-- ACC Payment -->
                <button class="btn btn-success btn-sm me-1" title="ACC Payment" data-bs-toggle="modal" data-bs-target="#accPaymentModal">
                  <i class="bi bi-check-circle"></i>
                </button>

                <!-- Detail Order -->
                <button class="btn btn-warning btn-sm text-white me-1" title="Detail Order" data-bs-toggle="modal" data-bs-target="#detailOrderModal">
                  <i class="bi bi-clipboard-data"></i>
                </button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  @else
  <div class="alert alert-info text-center mt-3">
    Belum ada notifikasi atau order baru.
  </div>
  @endif
</div>

<!-- Modal ACC Payment -->
<div class="modal fade" id="accPaymentModal" tabindex="-1" aria-labelledby="accPaymentModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="{{ route('orders.updatePayment') }}" method="POST">
        @csrf
        @method('PATCH') <!-- kalau kamu pakai PATCH untuk update -->
        <div class="modal-header">
          <h5 class="modal-title w-100 text-center fw-bold" id="accPaymentModalLabel" style="color: #001F54;">Check Order Payment</h5>
          <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <p class="fs-5">Have you received the 20 thousand rupiah?</p>

          <!-- Kamu butuh ID order untuk diupdate, misalnya di hidden input -->
          <input type="hidden" name="order_id" id="order_id" value="">

          <div class="d-flex justify-content-center gap-3 mt-4">
            <button type="submit" class="btn btn-success px-4">Yes</button>
            <button type="button" class="btn btn-danger px-4" data-bs-dismiss="modal">No</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>



<!-- Modal Order Details -->
<div class="modal fade" id="detailOrderModal" tabindex="-1" aria-labelledby="detailOrderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="detailOrderModalLabel">Order Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered text-center">
            <thead class="table-primary">
              
              <tr>
                <th>Date</th>
                <th>Service Type</th>
                <th>Detail Clothes</th>
                <th>Price</th>
                <th>Status Payment</th>
                <th>Manage</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>2025-05-30</td>
                <td>Dry Clean</td>
                <td>Shirt x2, Pants x1</td>
                <td>Rp20.000</td>
                <td>
                  <span class="badge bg-success">Paid</span>
                </td>
                <td>
                  <!-- Tombol Manage Order (panggil modal berikutnya) -->
                  <button class="btn btn-outline-primary btn-sm" title="Manage Order" data-bs-toggle="modal" data-bs-target="#manageOrderModal" data-bs-dismiss="modal">
                    <i class="bi bi-pencil-square"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Manage Order -->
<div class="modal fade" id="manageOrderModal" tabindex="-1" aria-labelledby="manageOrderModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 shadow p-3">
      <div class="modal-header border-0">
        <h5 class="modal-title fw-bold text-center w-100 text-primary" id="manageOrderModalLabel">Manage Order</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        
        <form id="manageOrderForm" action="{{ route('orders.manage') }}" method="POST">
          @csrf
          <input type="hidden" name="order_id" id="orderIdInput">
          <div class="mb-4">
            <select name="status" id="statusSelect" class="form-select text-center border-primary" style="max-width: 300px; margin: 0 auto;">
              <option selected disabled>Manage Order</option>
              <option value="pick_up">Pick Up</option>
              <option value="service">Service</option>
              <option value="packing">Packing</option>
              <option value="delivery">Delivery</option>
              <option value="completed">Completed</option>
            </select>
          </div>
          <div class="d-flex justify-content-center gap-3">
            <button type="submit" class="btn btn-primary px-4">Manage</button>
            <button type="button" class="btn btn-danger px-4" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
        
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  // Modal Manage Order dipanggil dari tombol Manage Order di modal Detail Order otomatis tutup modal detail
  var manageOrderModalEl = document.getElementById('manageOrderModal')
  var detailOrderModalEl = document.getElementById('detailOrderModal')

  // Saat tombol Manage Order di modal Detail Order diklik
  document.querySelectorAll('[data-bs-target="#manageOrderModal"]').forEach(function(button) {
    button.addEventListener('click', function () {
      var detailModal = bootstrap.Modal.getInstance(detailOrderModalEl);
      if(detailModal) detailModal.hide();
    });
  });

  // Simulasi submit form Manage Order
  document.getElementById('manageOrderForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const status = document.getElementById('statusSelect').value;
    if(!status || status === "Manage Order") {
      alert('Please select a status.');
      return;
    }
    alert('Order set to "' + status + '" (simulasi).');
    bootstrap.Modal.getInstance(manageOrderModalEl).hide();
  });
</script>
@endpush

@endsection
