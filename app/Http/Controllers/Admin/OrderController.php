<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceOrderMailable;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    
    public function index(Request $request){

            $orders = Order::when($request->filled('date'), function ($q) use ($request) {
                    return $q->whereDate('created_at', $request->date);
                })
                ->when($request->filled('status'), function ($q) use ($request) {
                    return $q->where('status_message', $request->status);
                })
                ->latest()
                ->paginate(5);

    return view('admin.orders.index', compact('orders'));

        // $todayDate = Carbon::now();
        // $orders = Order::whereDate('created_at', $todayDate)->paginate(10);

        // $todayDate = Carbon::now()->format('y-m-d');
        // $orders = Order::when($request->date != null, function ($q) use($request) {
        //                     return $q->whereDate('created_at', $request->date);
        //                     }, function ($q) use ($todayDate){
        //                         return $q->whereDate('created_at', $todayDate);
        //                     }
        //                     )

        //                     ->when($request->status != null, function ($q) use($request) {
        //                         return $q->where('status_message', $request->status);
        //                     })
        //                     ->paginate(10);
        // return view('admin.orders.index', compact('orders'));
    }

    public function show($orderId){

        $order = Order::where('id', $orderId)->first();
        if($order){
            return view('admin.orders.show', compact('order'));
        }
        else{
            return redirect('/admin/orders')->with('message', 'Order Id not Found!');
        }
        
    }
    

    public function updateOrderStatus(int $orderId, Request $request){

        $validator = Validator::make($request->all(), [
            'order_status' => 'required|string',
        ], [
            'order_status.required' => 'Please select an order status.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $order = Order::find($orderId);

        if ($order) {
            $order->update([
                'status_message' => $request->order_status
            ]);
            return redirect('/admin/orders/' . $order->id)->with('message', 'Order Status Updated!');
        } else {
            return redirect('/admin/orders/' . $orderId)->with('message', 'Order ID not found!');
        }
    }


    public function viewInvoice(int $orderId){
        $order = Order::findOrFail($orderId);
        return view('admin.invoice.generate-invoice', compact('order'));
    }

    public function generateInvoice(int $orderId){
        $order = Order::findOrFail($orderId);
        
        $data = ['order' => $order];
        $pdf = Pdf::loadView('admin.invoice.generate-invoice', $data);

        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('invoice-'.$order->id.'-'.$todayDate.'.pdf');
    }

    public function mailInvoice(int $orderId){
        $order = Order::findOrFail($orderId);
        try{
            Mail::to($order->email)->send(new InvoiceOrderMailable($order));
            return redirect('admin/orders/'.$orderId)->with('message', 'Invoice Mail has been sent to'.$order->email);
        }
        catch(\Exception $e){
            return redirect('admin/orders/'.$orderId)->with('error', 'Something went Wrong!'. $e->getMessage());
        }
    }

}