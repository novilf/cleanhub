@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fs-4 fw-semibold">Orders</h2>

    <div class="d-flex justify-content-end mb-3">
    <div class="input-group" style="width: 200px;">
        <span class="input-group-text bg-white"><i class="bi bi-search"></i></span>
        <input type="text" id="search" class="form-control" placeholder="Search...">
    </div>
</div>

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <div class="d-flex justify-content-end">
                <a href="{{ route('export.excel') }}" class="btn btn-sm text-white" style="background-color: #001F54;">
                    Export Excel
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Order Detail</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp

                        @forelse($notifications as $order)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td><strong>{{ $order['username'] }}</strong></td>

                            <td>
                                @foreach(($order['detail_clothes'] ?? []) as $item)
                                    {{ $item['name'] ?? '-' }} {{ $item['qty'] ?? '' }}x<br>
                                @endforeach
                            </td>
                            <td>Rp{{ number_format($order['total_price'], 0, ',', '.') }}</td>
                            <td><span class="fw-semibold">{{ ucfirst($order['status']) }}</span></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No orders found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
