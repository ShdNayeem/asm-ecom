<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;
use Razorpay\Api\Dispute;
use Illuminate\Support\Carbon;

class CheckoutController extends Controller
{
    public function index(){
        return view('frontend.checkout.index');
    }
    
    
}
