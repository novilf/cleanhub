<?php
namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;

class OrdersExport implements FromCollection
{
    public function collection()
    {
        // Ambil semua data orders
        return Order::all();
    }
}
