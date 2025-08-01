<?php

namespace App\Livewire\Frontend\Product;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use Dom\Document;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class View extends Component
{

    public function updateQuantityOnCartChange()
    {
        $productId = $this->product->id;

        if (auth()->check()) {
            $cartItem = Cart::where('user_id', auth()->id())->where('product_id', $productId)->first();

            if ($cartItem) {
                $this->quantityCount = $cartItem->quantity;
            }
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$productId])) {
                $this->quantityCount = $cart[$productId]['quantity'];
            }
        }
    }

    public function addToWishList($productId){
        sleep(1);
        if(Auth::check()){
            if(Wishlist::where('user_id',auth()->user()->id )->where('product_id', $productId)->exists()){
                session()->flash('message', 'Already Added to WishList!');
                $this->dispatch('message',
                text : 'Already Added to Wishlist!',
                type : 'warning',
                status : 409
            );
        }
            else{
                Wishlist::create([
                'user_id' => auth()->user()->id,
                'product_id' => $productId
            ]);
                $this->dispatch('wishlistUpdated');
                session()->flash('message', 'WishList Added Successfully!');
                $this->dispatch('message',
                text : 'WishList Added Successfully!',
                type : 'success',
                status : 200
            );
            }
            
        }
        else{
            session()->flash('message', 'Please Login to Continue!');
            $this->dispatch('message',
                text : 'Please Login to add to Wishlist!',
                type : 'info',
                status : 401
            );
            return false;
        }
    }

    public $category, $product, $quantityCount = 1;
    public $cartProductIds = [];

    public function mount($category, $product){
        $this->category = $category;
        $this->category = $product;

        $productId = $product->id;

    if (auth()->check()) {
        $cartItem = Cart::where('user_id', auth()->id())->where('product_id', $productId)->first();
        if ($cartItem) {
            $this->quantityCount = $cartItem->quantity;
        }
    } else {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $this->quantityCount = $cart[$productId]['quantity'];
        }
    }

    // Added button --- disable added & (- , +)
    if (auth()->check()) {
        $this->cartProductIds = Cart::where('user_id', auth()->id())->pluck('product_id')->toArray();
    } else {
        $sessionCart = session()->get('cart', []);
        $this->cartProductIds = array_keys($sessionCart);
    }
    }

    public function incrementQuantity(){
        if($this->quantityCount < 10 ){
            $this->quantityCount++;
        }
        
    }

    public function decrementQuantity(){
        if($this->quantityCount > 1){
            $this->quantityCount--;
        }
        
    }

   
    public function addToCart(int $productId){
        
        if(Auth::check()){
            if(Cart::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()){
            //     $this->dispatch('message',
            //     text : 'Product Already Added to Cart',
            //     type : 'warning',
            //     status : 200
            // );
            }
            else{
                if($this->product->where('id', $productId)->exists()){
                Cart::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId,
                    'quantity' => $this->quantityCount
                ]);
                $this->dispatch('CartUpdated');
                $this->dispatch('message',
                text : 'Product Added to Cart',
                type : 'success',
                status : 200
            );
            }
            else{
                $this->dispatch('message',
                text : 'Product Does not Exist!',
                type : 'warning',
                status : 404
            );
            }
            }
            if (!in_array($productId, $this->cartProductIds)) {
            $this->cartProductIds[] = $productId;
            }
        }
        else{
            // $this->dispatch('message',
            //     text : 'Please Login to add to Cart!',
            //     type : 'info',
            //     status : 401
            // );
            
            $quantity = 1;
            $product = Product::findOrFail($productId);
            $cart = session()->get('cart', []);

           if(isset($cart[$productId])) {
            
            // $this->dispatch('message',
            //     text: 'Product Already Added to Cart',
            //     type: 'warning',
            //     status: 200
            //     );
            }
            else{
                $cart[$productId] = [
                    'name' => $product->name,
                    'quantity' => $this->quantityCount,
                    'price' => $product->offer_price,
                    'image' => asset($product->productImages[0]->image),
                    'slug' => $product->slug,
                    'category_slug' => $product->category->slug,
            ];
            session()->put('cart', $cart);

            $this->dispatch('CartUpdated');
            $this->dispatch('message',
                text: 'Product Added to Cart',
                type: 'success',
                status: 200
            );
            }
        }
        if (!in_array($productId, $this->cartProductIds)) {
            $this->cartProductIds[] = $productId;
            }
    }

    protected $listeners = [
    'ProductQuantityUpdated' => 'syncQuantityFromSidebar',
    ];

    public function syncQuantityFromSidebar($productId, $quantity)
    {
        if ($this->product->id == $productId) {
            $this->quantityCount = $quantity;
        }
    }

    public function render()
    {
        return view('livewire.frontend.product.view', [
            'product' => $this->product,
            'category' => $this->category
        ]);
    }
}