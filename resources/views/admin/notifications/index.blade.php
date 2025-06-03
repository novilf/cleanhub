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
              <th>Service Type</th>
              <th>Detail Clothes</th>
              <th>Price</th>
              <th>Payment Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($notifications as $index => $notif)
            <tr class="{{ $index % 2 == 0 ? 'table-light' : 'table-primary' }}">
              <td>{{ $index + 1 }}.</td>
              <td class="fw-bold">{{ $notif['date'] }}</td>
              <td>{{ $notif['username'] }}</td>
              <td>{{ $notif['service_type'] }}</td>
              <td>{{ $notif['detail_clothes'] }}</td>
              <td>Rp{{ number_format($notif['price'], 0, ',', '.') }}</td>
              <td>
                @if($notif['payment_status'] == 'paid')
                  <span class="badge bg-success">Paid</span>
                @else
                  <span class="badge bg-danger">Unpaid</span>
                @endif
              </td>
              <td>
                <!-- Detail Order -->
                <button class="btn btn-warning btn-sm text-white me-1" title="Detail Order" data-bs-toggle="modal" data-bs-target="#detailOrderModal" 
                  data-order-id="{{ $notif['id'] }}"
                  data-date="{{ $notif['date'] }}"
                  data-service="{{ $notif['service_type'] }}"
                  data-details="{{ $notif['detail_clothes'] }}"
                  data-price="{{ $notif['price'] }}"
                  data-status="{{ $notif['payment_status'] }}">
                  <i class="bi bi-clipboard-data"></i>
                </button>

                <!-- Validate Payment -->
                @if($notif['payment_status'] == 'unpaid')
                <form action="{{ route('orders.validatePayment', $notif['id']) }}" method="POST" class="d-inline">
                  @csrf
                  <button type="submit" class="btn btn-success btn-sm me-1" title="Validate Payment">
                    <i class="bi bi-check-circle"></i>
                  </button>
                </form>
                @endif

                <!-- Manage Order -->
                <button class="btn btn-outline-primary btn-sm" title="Manage Order" data-bs-toggle="modal" data-bs-target="#manageOrderModal" data-order-id="{{ $notif['id'] }}">
                  <i class="bi bi-pencil-square"></i>
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
                <td id="detail-date"></td>
                <td id="detail-service"></td>
                <td id="detail-clothes"></td>
                <td id="detail-price"></td>
                <td id="detail-status"></td>
                <td>
                  <!-- Removed Manage Order button from here -->
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
  // Set order details for detail modal
  document.querySelectorAll('[data-bs-target="#detailOrderModal"]').forEach(function(button) {
    button.addEventListener('click', function() {
      document.getElementById('detail-date').textContent = this.dataset.date;
      document.getElementById('detail-service').textContent = this.dataset.service;
      document.getElementById('detail-clothes').textContent = this.dataset.details;
      document.getElementById('detail-price').textContent = 'Rp' + new Intl.NumberFormat('id-ID').format(this.dataset.price);
      document.getElementById('detail-status').innerHTML = this.dataset.status === 'paid' 
        ? '<span class="badge bg-success">Paid</span>' 
        : '<span class="badge bg-danger">Unpaid</span>';
    });
  });

  // Set order ID for manage modal
  document.querySelectorAll('[data-bs-target="#manageOrderModal"]').forEach(function(button) {
    button.addEventListener('click', function() {
      document.getElementById('orderIdInput').value = this.dataset.orderId;
    });
  });

  // Form validation for manage order
  document.getElementById('manageOrderForm').addEventListener('submit', function(e) {
    const status = document.getElementById('statusSelect').value;
    if(!status || status === "Manage Order") {
      e.preventDefault();
      alert('Please select a status.');
    }
  });
</script>
@endpush

@endsection
