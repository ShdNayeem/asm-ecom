<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Offer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Slider;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function index(){

        $totalCategories = Category::count();
        $totalProducts = Product::count();
        $totalSliders = Slider::count();
        $totalOffers = Offer::count();
        $totalDiscounts = Discount::count();

        $totalAllUsers = User::count();
        $totalUser = User::where('role_as', '0')->count();
        $totalAdmin = User::where('role_as', '1')->count();

        $todayDate = Carbon::today();
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');
        $totalOrders = Order::count();
        $todayOrder = Order::whereDate('created_at', $todayDate)->count();
        $thisMonthOrder = Order::whereMonth('created_at', $thisMonth)->count();
        $thisYearOrder = Order::whereYear('created_at', $thisYear)->count();


        return view('admin.dashboard', compact('totalCategories','totalProducts', 'totalSliders', 'totalOffers', 'totalDiscounts', 'totalAllUsers', 'totalUser', 'totalAdmin',
                                                'todayDate', 'thisMonth', 'thisYear', 'totalOrders', 'todayOrder', 'thisMonthOrder', 'thisYearOrder'));
    }
}