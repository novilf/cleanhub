<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;  // Model order
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    // Get orders for notification sidebar (not completed)
    public function notificationOrders()
    {
        $orders = Order::where('laundry_status', '!=', 'completed')->get();
        return response()->json($orders);
    }

    // Get orders for orders sidebar (completed)
    public function completedOrders()
    {
        $orders = Order::where('laundry_status', 'completed')->get();
        return response()->json($orders);
    }

    // Validasi pembayaran
    public function validatePayment($id)
{
    $order = \App\Models\Order::findOrFail($id);
    $order->payment_status = 'paid';
    $order->save();

    return redirect()->back()->with('success', 'Payment marked as paid!');
}


    // Update status laundry
    public function updateLaundryStatus(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->laundry_status = $request->laundry_status;
        $order->save();

        return response()->json(['message' => 'Status laundry diupdate']);
    }

    // Tambahan: method index untuk halaman notifications
    public function index()
    {
        $orders = Order::with('usermobile')
            ->where('payment_status', 'paid')
            ->get();
        $notifications = $orders->map(function ($item) {
            return [
                'id' => $item->id,
                'date' => date('Y-m-d', strtotime($item->date)),
                'username' => $item->usermobile->name ?? 'Unknown',
                'price' => $item->price,
                'detail_clothes' => json_decode($item->detail_clothes, true) ?? [],
                'payment_status' => $item->payment_status,
                'laundry_status' => $item->laundry_status,
                'status' => $item->laundry_status,
                'total_price' => $item->price,
            ];
        })->toArray();
        return view('admin.orders.index', ['notifications' => $notifications]);
    }
    
    public function manage(Request $request)
{
    $order = Order::find($request->order_id);
    if (!$order) {
        return redirect()->back()->with('error', 'Order not found.');
    }

    $order->status = $request->status;  // asumsikan kolom di DB bernama 'status'
    $order->save();

    return redirect()->back()->with('success', 'Order updated successfully.');
}

}

