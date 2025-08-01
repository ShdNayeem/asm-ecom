<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';
    
    protected function authenticated(Request $request, $user)
    {
        
        $sessionCart = session()->get('cart', []);

    foreach ($sessionCart as $productId => $details) {
        $existing = Cart::where('user_id', $user->id)->where('product_id', $productId)->first();

        if ($existing) {
            $existing->quantity += $details['quantity'];
            $existing->save();
        } else {
            
            Cart::create([
                'user_id' => $user->id,
                'product_id' => $productId,
                'quantity' => $details['quantity']
            ]);
        }
    }
    //
    // session()->forget('cart');

    if(Auth::check() && Auth::user()->role_as == '1'){
            return redirect('/admin/dashboard')->with('message', 'Welcome to Dashboard');
        }
        else {
            $sessionCart = session()->get('cart', []);

            if (!empty($sessionCart)) {
                return redirect('/cart');
            } else {
                return redirect('/home')->with('status', 'Logged In Successfully!');
            }
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}