<?php

namespace App\Livewire\Frontend\Cart;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartCount extends Component
{

    public $CartCount;

    protected $listeners = ['CartUpdated' => 'CheckCartCount'];
    
    public function CheckCartCount(){
        if(Auth::check()){
            return $this->CartCount = Cart::where('user_id', auth()->user()->id)->count();
        }
        else{
            $cart = session()->get('cart', []);
            $this->CartCount = count($cart);
        }
        return $this->CartCount;
    }

    public function render()
    {
        $this->CartCount = $this->CheckCartCount();
        return view('livewire.frontend.cart.cart-count',[
            'cartCount' => $this->CartCount
        ]);
    }
}
