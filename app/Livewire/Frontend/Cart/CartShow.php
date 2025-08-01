<?php

namespace App\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{
    public $cart, $totalPrice = 0;
    public $cartQuantity = 1;

    public function incrementQuantity(int $cartId){
        $cardData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
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
            $this->dispatch('CartUpdated');
        $this->dispatch('ProductQuantityUpdated', productId: $cardData->product_id, quantity: $cardData->quantity);
        }
    public function decrementQuantity(int $cartId){
        $cardData = Cart::where('id', $cartId)->where('user_id', auth()->user()->id)->first();
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
            $this->dispatch('CartUpdated');
        $this->dispatch('ProductQuantityUpdated', productId: $cardData->product_id, quantity: $cardData->quantity);
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
           
        }
    }

    public function mount()
{
    if (!auth()->check()) {
        return redirect('/login');
    }
}

 

    protected $listeners = [
    'CartUpdated' => 'loadCart',
    'ProductQuantityUpdated' => 'syncCartItemQuantity',
];

    public function syncCartItemQuantity($productId, $quantity)
{
    if (auth()->check()) {
        foreach ($this->cart as $cartItem) {
            if ($cartItem->product_id == $productId) {
                $cartItem->quantity = $quantity; // Temporarily update the in-memory cart object
                break;
            }
        }
    } else {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
            $this->cart = collect($cart);
        }
    }
    }

    public function render()
{
    $this->cart = Cart::where('user_id', auth()->user()->id)->get();

    return view('livewire.frontend.cart.cart-show', [
        'cart' => $this->cart,
        'totalPrice' => $this->totalPrice,
    ]);
}
}