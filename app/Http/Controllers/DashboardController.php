<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard'); // nanti kamu buat file view-nya di resources/views/admin/dashboard.blade.php
    }
}

