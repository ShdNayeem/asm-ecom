<?php

namespace App\Livewire\Frontend\SidebarCart;

use App\Models\Cart;
use Livewire\Component;

class SidebarCartShow extends Component
{
    
    public $cart, $totalPrice = 0;
    public $cartQuantity = 1;

    public function incrementQuantity(int $cartId){
        $cardData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
        if($cardData){
            if($cardData->quantity < 10){
                $cardData->increment('quantity');
                
                $updatedQuantity = $cardData->quantity + 1;
                
            $this->dispatch('message',
                text : 'Quantity Updated',
                type : 'success',
                status : 200
            );
            
            }
            else{
                $this->dispatch('message',
                text : 'You have Reached the Maximum Quantity!',
                type : 'warning',
                status : 200
            );
            }
        }
        $this->dispatch('CartUpdated');
        $this->dispatch('ProductQuantityUpdated', productId: $cardData->product_id, quantity: $cardData->quantity);        
    }

    public function incrementGuestQuantity($productId){
    $cart = session()->get('cart', []);

    if (isset($cart[$productId])) {
        if ($cart[$productId]['quantity'] < 10) {
            $cart[$productId]['quantity'] ++; 
            session()->put('cart', $cart); // Save back to session
            
            $this->cart = collect($cart);

            $this->dispatch('CartUpdated');
        $this->dispatch('message',
                text : 'Quantity Updated!',
                type : 'success',
                status : 200
            );
            
        } else {
            $this->dispatch('message',
                text : 'You have Reached the Maximum Quantity!',
                type : 'warning',
                status : 200
            );
        }
    }
        $this->dispatch('CartUpdated');
        $this->dispatch('ProductQuantityUpdated', productId: $productId, quantity: $cart[$productId]['quantity']);

        
}

    public function decrementQuantity(int $cartId){
        $cardData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
        if($cardData){
            if($cardData->quantity > 1){
                
                $this->dispatch('CartUpdated');
                $cardData->decrement('quantity');
                $cardData->refresh();
            $this->dispatch('message',
                text : 'Quantity Updated',
                type : 'success',
                status : 200
            );
            }
            else{
                $this->dispatch('CartUpdated');
                $this->dispatch('message',
                text : 'Mimimum Quantity is 1',
                type : 'warning',
                status : 200
            );
            }
        }
        $this->dispatch('CartUpdated');
        $this->dispatch('ProductQuantityUpdated', productId: $cardData->product_id, quantity: $cardData->quantity);
    }

    public function decrementGuestQuantity($productId){
    $cart = session()->get('cart', []);

    if (isset($cart[$productId])) {
        if ($cart[$productId]['quantity'] > 1) {
            $cart[$productId]['quantity'] --; 
            session()->put('cart', $cart); // Save back to session

            $this->cart = collect($cart);
            
            $this->dispatch('CartUpdated');
        $this->dispatch('message',
                text : 'Quantity Updated!',
                type : 'success',
                status : 200
            );
        } else {
            $this->dispatch('message',
                text : 'Mimimum Quantity is 1',
                type : 'warning',
                status : 200
            );
        }
    }
    
    $this->dispatch('CartUpdated');
    $this->dispatch('ProductQuantityUpdated', productId: $productId, quantity: $cart[$productId]['quantity']);
}

    public function removeCartItem(int $cartId){
        $removeCartItem = Cart::where('user_id', auth()->user()->id)->where('id', $cartId)->first();
        if($removeCartItem){
            $removeCartItem->delete();
            
            $this->dispatch('CartUpdated');
                $this->dispatch('message',
                text : 'Product removed from cart',
                type : 'success',
                status : 200
            );
        }
    }

    public function removeGuestCartItem($productId){
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
            
            $this->dispatch('CartUpdated');
                $this->dispatch('message',
                text : 'Product removed from cart',
                type : 'success',
                status : 200
            );
    }
}


        protected $listeners = [
            'CartUpdated' => 'updateQuantityOnCartChange',
            'ProductQuantityUpdated' => 'syncQuantityFromSidebar',
            
        ];
        
        public $quantityCount = 1;

        public function loadCart()
        {
            if (auth()->check()) {
                $this->cart = Cart::where('user_id', auth()->id())->get();
                
            } else {
                $this->cart = collect(session()->get('cart', []));
                
            }
        }

        

    public function render()
    {
        // $this->cart = Cart::where('user_id', auth()->user()->id)->get();
        // return view('livewire.frontend.sidebar-cart.sidebar-cart-show', [
        //     'cart' => $this->cart
        // ]);
        
        if (auth()->check()) {
        $this->cart = Cart::where('user_id', auth()->id())->get();
        } else {
            $this->cart = collect(); // empty collection when not logged in
        }

    return view('livewire.frontend.sidebar-cart.sidebar-cart-show', [
        'cart' => $this->cart
    ]);
    }
}