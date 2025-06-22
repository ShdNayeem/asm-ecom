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
            return $this->CartCount = 0;
        }
    }

    public function render()
    {
        $this->CartCount = $this->CheckCartCount();
        return view('livewire.frontend.cart.cart-count',[
            'cartCount' => $this->CartCount
        ]);
    }
}
