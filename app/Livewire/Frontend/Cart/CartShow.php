<?php

namespace App\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{
    public $cart, $totalPrice = 0;
    // public $cartQuantity = 1;

    // public function incrementQuantity(int $cartId){
    //     $cardData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
    //     if($cardData){
    //         $cardData->increment('quantiity');
    //         $this->dispatch('message',
    //             text : 'Product Already Added to Cart',
    //             type : 'warning',
    //             status : 200
    //         );
    //     }
        
    // }

    // public function decrementQuantity(){
    //     $cardData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
    //     if($cardData){
    //         $cardData->decrement('quantiity');
    //         $this->dispatch('message',
    //             text : 'Product Already Added to Cart',
    //             type : 'warning',
    //             status : 200
    //         );
    //     }
    // }

    public $quantities = [];

    public function mount()
    {
        foreach (Cart::where('user_id', auth()->id())->get() as $cartItem) {
            $this->quantities[$cartItem->id] = 1;
        }
    }

    public function incrementQuantity(int $cartId)
    {
        if ($this->quantities[$cartId] < 10) {
            $this->quantities[$cartId]++;
            $this->dispatch('message',
            text : 'Quantity Updated',
            type : 'success',
            status : 200
        );
        }
    }

    public function decrementQuantity(int $cartId)
    {
        if ($this->quantities[$cartId] > 1) {
            $this->quantities[$cartId]--;
            $this->dispatch('message',
        text : 'Quantity Updated',
        type : 'success',
        status : 200
        );
        }
    }

    public function removeCartItem(int $cartId){
        $removeCartItem = Cart::where('user_id', auth()->user()->id)->where('id', $cartId)->first();
        if($removeCartItem){
            $removeCartItem->delete();
            
            $this->dispatch('CartUpdated');
                $this->dispatch('message',
                text : 'Cart Item Deleted',
                type : 'success',
                status : 200
            );
        }
        else{
            
            //     $this->dispatch('message',
            //     text : 'Something went Wrong',
            //     type : 'error',
            //     status : 500
            // );
        }
    }

    public function render()
    {
        $this->cart = Cart::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-show', [
            'cart' => $this->cart
        ]);
    }
}
