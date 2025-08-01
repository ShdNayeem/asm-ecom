<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Orderitem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Razorpay\Api\Api;

class RazorpayController extends Controller
{
    public function index(){
        return view('frontend.razorpay.payment');
    }

    public $totalPrice = 0;
    public $carts, $totalProductAmount;
    public $discount = 0;
    public $appliedCoupon = '';

    public $fullname, $email, $phone, $pincode, $address, $payment_mode = NULL, $payment_id = NULL;

    public function payment(Request $request){
        $request->validate([
            'fullname' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'pincode' => 'required|string',
            'address' => 'required|string|max:250',
        ]);

        $this->fullname = $request->fullname;
        $this->email = $request->email;
        $this->phone = $request->phone;
        $this->pincode = $request->pincode;
        $this->address = $request->address;

        $this->carts = Cart::where('user_id', auth()->id())->get();

        $this->totalProductAmount = 0;
        foreach ($this->carts as $cartItem) {
            $this->totalProductAmount += $cartItem->product->offer_price * $cartItem->quantity;
        }

        // Apply discount if present
        $this->discount = session('discount') ?? 0;
        $this->appliedCoupon = session('applied_coupon') ?? '';

        $finalPayableAmount = $this->totalProductAmount - $this->discount;

        // Ensure amount doesn't go below zero
        if ($finalPayableAmount < 0) {
            $finalPayableAmount = 0;
        }

        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $razorpayOrder = $api->order->create([
            'receipt' => 'order_' . uniqid(),
            'amount' => $finalPayableAmount * 100, // in paise
            'currency' => 'INR',
            'payment_capture' => 1,
        ]);

        // Storing the Razorpay temporarily using session
        session([
            'razorpay_order_id' => $razorpayOrder['id'],
            'user_checkout_data' => [
                'fullname' => $this->fullname,
                'email' => $this->email,
                'phone' => $this->phone,
                'pincode' => $this->pincode,
                'address' => $this->address,
                'total_amount' => $finalPayableAmount,
                'discount' => $this->discount,
                'applied_coupon' => $this->appliedCoupon,
            ]
        ]);

        return view('frontend.razorpay.payment', [
            'orderId' => $razorpayOrder['id'],
            'name' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'price' => $finalPayableAmount,
            'razorpayKey' => env('RAZORPAY_KEY'),
        ]);
    }

    public function success(Request $request){
        if (!$request->razorpay_payment_id || !$request->razorpay_order_id) {
            return back()->with('error', 'Payment failed. Please try again.');
        }

        $user = auth()->user();
        $cartItems = Cart::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Cart is empty.');
        }

        $checkoutData = session('user_checkout_data');
            if (!$checkoutData) {
                return back()->with('error', 'Session expired. Please try again.');
            }

            // Get coupon details from session if available
            $discount = session('discount') ?? 0;
            $couponCode = session('applied_coupon') ?? null;

            // Calculate total and final amount
            $totalAmount = 0;
            foreach ($cartItems as $item) {
                $totalAmount += $item->product->offer_price * $item->quantity;
            }

            $finalAmount = $totalAmount - $discount;
            if ($finalAmount < 0) $finalAmount = 0;

            $order = Order::create([
                'user_id' => $user->id,
                'tracking_no' => 'asm-' . Str::random(10),
                'fullname' => $checkoutData['fullname'],
                'email' => $checkoutData['email'],
                'phone' => $checkoutData['phone'],
                'pincode' => $checkoutData['pincode'],
                'address' => $checkoutData['address'],
                'status_message' => 'in progress',
                'payment_mode' => 'Paid by Razorpay',
                'payment_id' => $request->razorpay_payment_id,
                'discount' => $discount,
                'coupon_code' => $couponCode,
                'final_amount' => $finalAmount,
                ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->offer_price,
                ]);
            }

            Cart::where('user_id', $user->id)->delete();
            session()->forget(['razorpay_order_id', 'user_checkout_data']);

            return redirect('/orders/' . $order->id)->with('message', 'Payment Paid Successfully!');
        }

}