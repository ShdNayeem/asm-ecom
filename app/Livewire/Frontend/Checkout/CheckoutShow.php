<?php

namespace App\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Discount;
use App\Models\Order;
use App\Models\Orderitem;
use Illuminate\Support\Facades\Request;
use Livewire\Component;
use Illuminate\Support\Str;
use Razorpay\Api\Api;
use Illuminate\Support\Carbon;

class CheckoutShow extends Component
{

    public $totalPrice = 0;
    public $carts, $totalProductAmount = 0;
    public $coupon_code;
    public $discount = 0, $appliedCoupon = '', $message = '', $error = '';

    public $fullname, $email, $phone, $pincode, $address, $payment_mode = NULL, $payment_id = NULL ;

    public function rules(){
        return [
            'fullname' =>'required|string|max:121',
            'email' =>'required|email|max:121',
            'phone' =>'required|numeric|min:10|digits:10',
            'pincode' =>'required|string|max:6|min:6',
            'address' =>'required|string|max:500'
        ];
    }

    // COD Order
    public  function placeOrder(){

        $this->validate();

        $discount = session('discount') ?? 0;
        $couponCode = session('applied_coupon') ?? null;

        $finalAmount = $this->totalProductAmount - $discount;
        if ($finalAmount < 0) {
            $finalAmount = 0;
        }

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'tracking_no' => 'asm-'.Str::random(10),
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'pincode' => $this->pincode,
            'address' => $this->address,
            'status_message' => 'in progress',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id,
            'discount' => $discount,
            'coupon_code' => $couponCode,
            'final_amount' => $finalAmount,
        ]);

        foreach($this->carts as $cartItem){

            $orderItems = Orderitem::create([
            'order_id' => $order->id,
            'product_id' => $cartItem->product_id,
            'quantity' => $cartItem->quantity,
            'price' => $cartItem->product->offer_price
        ]);
        $this->totalProductAmount += $cartItem->product->offer_price * $cartItem->quantity;

        }
        return $order;
    }

    public function codOrder(){

        $this->payment_mode = 'Cash on Delivery';
        $codOrder = $this->placeOrder();

        if($codOrder){
            Cart::where('user_id', auth()->user()->id)->delete();

            session()->flash('message', 'Order Placed Successfully!');
            $this->dispatch('message',
                text : 'Order Placed Successfully!',
                type : 'success',
                status : 200
            );
            return redirect('/orders/' . $codOrder->id)->with('message', 'Payment Paid Successfully!');
        }
        else{
            $this->dispatch('message',
                text : 'Something went Wrong!',
                type : 'error',
                status : 500
            );
        }
    }

    public function mount()
{
    if (session()->has('discount')) {
        $this->discount = session('discount');
        $this->appliedCoupon = session('applied_coupon');
    }
}
    
    
    public function applyCoupon()
{
    $this->validate([
        'coupon_code' => 'required|string'
    ], [
        'coupon_code.required' => 'Please enter a coupon code.'
    ]);

    $today = Carbon::today();

    $coupon = Discount::where('discount_name', $this->coupon_code)
        ->where('is_active', 1)
        ->whereDate('valid_from', '<=', $today)
        ->whereDate('valid_to', '>=', $today)
        ->get()
        ->first(function ($item) {
        return $item->discount_name === $this->coupon_code; // Case sensitive match
    });

    if ($coupon) {
        $this->discount = $coupon->discount_value;
        $this->appliedCoupon = $coupon->discount_name;
        $this->message = 'Coupon Applied Successfully!';
        $this->error = '';

        // add to session
        session()->put('discount', $this->discount);
        session()->put('applied_coupon', $this->appliedCoupon);
    } else {
        $this->discount = 0;
        $this->appliedCoupon = '';
        $this->message = '';
        $this->error = 'Invalid or Expired coupon code.';

        session()->forget(['discount', 'applied_coupon']);
    }
}

public function clearCoupon()
{
    $this->discount = 0;
    $this->appliedCoupon = '';
    $this->coupon_code = '';
    $this->message = '';
    $this->error = '';

    // Clear session if you're using it
    session()->forget(['discount', 'applied_coupon']);
}
    
    public function totalProductAmount(){
        $this->totalProductAmount = 0;
        $this->carts = Cart::where('user_id', auth()->user()->id)->get();
        foreach($this->carts as $cartItem){
           $this->totalProductAmount += $cartItem->product->offer_price * $cartItem->quantity;
        }
        return $this->totalProductAmount;
    }
    
    public function render()
{
    if (auth()->check()) {
        // Load from database
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->carts = $cartItems;
    } else {
        // Load from session
        $cartItems = collect(session('cart', []));
        $this->carts = $cartItems;
    } 

    $this->totalProductAmount = $this->totalProductAmount();

    $discount = session('discount', 0);
    $finalTotal = $this->totalProductAmount - $discount;

    return view('livewire.frontend.checkout.checkout-show', [
        'cartProducts' => $this->carts,
        'totalProductAmount' => $this->totalProductAmount,
        'finalTotal' => $finalTotal,
        'discount' => $discount,
        'appliedCoupon' => session('applied_coupon'),
    ]);
}

}