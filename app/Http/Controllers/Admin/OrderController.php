<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    /**
     * Lihat semua pesanan
     */
    public function index()
    {
        $orders = Order::with('user')
            ->latest()
            ->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Lihat detail pesanan
     */
    public function show(Order $order)
    {
        $order->load(['user', 'orderItems.product']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Update status pesanan
     */
    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);

        $oldStatus = $order->status;
        $newStatus = $validated['status'];

        // Jika diubah ke cancelled dan sebelumnya bukan cancelled, kembalikan stok
        if ($newStatus === 'cancelled' && $oldStatus !== 'cancelled') {
            foreach ($order->orderItems as $item) {
                Product::where('id', $item->product_id)
                    ->increment('stock', $item->quantity);
            }
        }

        // Jika dari cancelled diubah ke status lain, kurangi stok lagi
        if ($oldStatus === 'cancelled' && $newStatus !== 'cancelled') {
            foreach ($order->orderItems as $item) {
                $product = Product::find($item->product_id);
                
                // Cek stok 
                if ($product->stock < $item->quantity) {
                    return back()->with('error', "Stok {$product->name} tidak mencukupi untuk mengaktifkan kembali pesanan");
                }
            }
            
            // Kurangi stok
            foreach ($order->orderItems as $item) {
                Product::where('id', $item->product_id)
                    ->decrement('stock', $item->quantity);
            }
        }

        $order->update(['status' => $newStatus]);

        return back()->with('success', 'Status pesanan diperbarui menjadi ' . ucfirst($newStatus));
    }


    /**
     * Update informasi pengiriman
     */
    public function updateShipping(Request $request, \App\Models\Order $order)
        {
            $data = $request->validate([
                'shipping_courier' => 'required|string|max:100',
                'shipping_tracking_number' => 'required|string|max:100',
            ]);

            $order->update($data); 

            return back()->with('success', 'Informasi pengiriman berhasil disimpan.');
        }



    /**
     * Hapus pesanan
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Pesanan berhasil dihapus');
    }

    /**
     * Download Invoice PDF (Admin)
     */
    public function downloadInvoice(Order $order)
    {
        $order->load('orderItems.product', 'user');
        $pdf = Pdf::loadView('orders.invoice-pdf', compact('order'));
        return $pdf->download('invoice-' . $order->order_number . '.pdf');
    }
}