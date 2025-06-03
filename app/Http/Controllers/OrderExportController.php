<?php
// app/Http/Controllers/OrderExportController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;

class OrderExportController extends Controller
{
    public function export()
    {
        return Excel::download(new OrdersExport, 'orders.xlsx');
    }
}
