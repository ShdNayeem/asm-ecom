<?php

namespace App\Livewire\Frontend;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $newArrivals;
    public $sliders;
    public array $cartProductIds = [];
    public $mobileProducts;
    public $mobileCategory;
    

    public function mount($mobileProducts, $mobileCategory)
    {
        $this->mobileProducts = $mobileProducts;
        $this->mobileCategory = $mobileCategory;
        $this->newArrivals = Product::latest()->take(4)->get();
        $this->sliders = Slider::all();

        //add to cart to added even with refresh
        if (auth()->check()) {
        $this->cartProductIds = Cart::where('user_id', auth()->id())->pluck('product_id')->toArray();
        } else {
            $sessionCart = session()->get('cart', []);
            $this->cartProductIds = array_keys($sessionCart);
        }
    }

    public $category, $product, $quantityCount = 1;

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
                if(Product::where('id', $productId)->exists()){
                Cart::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId,
                    'quantity' => $this->quantityCount
                ]);

                $this->cartProductIds[] = $productId;

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
        
        }
        else{
            // $this->dispatch('message',
            //     text : 'Please Login to add to Cart!',
            //     type : 'info',
            //     status : 401
            // );
            
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
                    'category_slug' => $product->category->slug
            ];
            session()->put('cart', $cart);

            $this->cartProductIds = array_keys($cart);

            $this->dispatch('CartUpdated');
            $this->dispatch('message',
                text: 'Product Added to Cart',
                type: 'success',
                status: 200
            );
            }
    }
}
    public function render()
    {
        return view('livewire.frontend.index');
    }
}
