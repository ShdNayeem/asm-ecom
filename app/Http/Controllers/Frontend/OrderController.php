<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('frontend.orders.index', compact('orders'));
    }

    public function show($orderId){
        $order = Order::where('user_id', auth()->user()->id)->where('id', $orderId)->first();
        if($order){
            return view('frontend.orders.show', compact('order'));
        }
        else{
            return redirect()->back()->with('message', 'No Order Found!');
        }
    }

    public function viewInvoice(int $orderId){
        $order = Order::findOrFail($orderId);
        return view('frontend.invoice.generate-invoice', compact('order'));
    }

    public function generateInvoice(int $orderId){
        $order = Order::findOrFail($orderId);
        
        $data = ['order' => $order];
        $pdf = Pdf::loadView('frontend.invoice.generate-invoice', $data);

        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('invoice-'.$order->id.'-'.$todayDate.'.pdf');
    }

}
