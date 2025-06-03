@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="row text-center mb-3">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Your Order Today</h6>
                    <h4 class="text-success">+10</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Your Income Today</h6>
                    <h4 class="text-success">10000</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6>Your Customer</h6>
                    <h4 class="text-success">20</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
    <div class="col-md-6">
        <div class="card shadow-sm p-3">
            <h6>Income</h6>
            <canvas id="incomeChart"></canvas>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-sm p-3">
            <h6>Order</h6>
            <canvas id="orderChart"></canvas>
        </div>
    </div>
</div>


    <div class="card shadow-sm">
        <div class="card-body">
            <h6>Last Order</h6>
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Date</th>
                            <th>Name</th>
                            <th>Detail</th>
                            <th>Qty</th>
                            <th>Sum</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Data Order Masuk Disini --}}
                        @for ($i = 1; $i <= 5; $i++)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>2025-05-30</td>
                            <td>User {{ $i }}</td>
                            <td>Pakaian Reguler</td>
                            <td>2</td>
                            <td>20000</td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const incomeChart = new Chart(document.getElementById('incomeChart'), {
        type: 'bar',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Income',
                data: [12000, 15000, 18000, 20000, 16000, 19000, 22000],
                backgroundColor: '#4051d3'
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } }
        }
    });

    const orderChart = new Chart(document.getElementById('orderChart'), {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Orders',
                data: [5, 8, 10, 12, 7, 11, 14],
                borderColor: '#ff4081',
                backgroundColor: 'rgba(255, 64, 129, 0.2)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } }
        }
    });
</script>
@endsection
