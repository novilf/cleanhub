<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Notification;
class NotificationController extends Controller
{

    public function index()
    {
        // Misal data kamu diambil dari database atau API
        // Contoh: ambil notifikasi dengan relasi usermobile
        $data_from_db = \App\Models\Order::with('usermobile')->get();

        // Mapping data supaya mudah dipakai di view
        $notifications = $data_from_db->map(function ($item) {
            return [
                'id' => $item->id,
                'date' => date('Y-m-d', strtotime($item->date)),
                'username' => $item->usermobile->name ?? 'Unknown',
                'price' => $item->price,
                'service_type' => $item->service_type,
                'detail_clothes' => $item->detail_clothes,
                'payment_status' => $item->payment_status,
                'laundry_status' => $item->laundry_status,
            ];
        })->toArray();

        return view('admin.notifications.index', compact('notifications'));
    }

        
}
