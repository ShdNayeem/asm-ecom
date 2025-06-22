<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">

        <h4>My Cart</h4>
        <hr>
    
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">

                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Quantity</h4>
                                </div>
                                <div class="col-md-1">
                                    <h4>Total</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>

                        @forelse ($cart as $cartItem)
                        @if ($cartItem->product)
                            <div class="cart-item">
                            <div class="row">
                                <div class="col-md-6 my-auto">

                                    <a href="{{ url ('collections/'.$cartItem->product->category->slug.'/'.$cartItem->product->slug )}}">
                                        <label class="product-name">

                                        @if ($cartItem->product->firstImage->image)
                                            <img src="{{ asset($cartItem->product->firstImage->image) }}" style="width: 50px; height: 50px" alt="">
                                        @else
                                            <img src="" style="width: 50px; height: 50px" alt="">
                                        @endif
                                            
                                            {{$cartItem->product->name}}
                                        </label>
                                    </a>
                                </div>

                                <div class="col-md-1 my-auto">
                                    <label class="price">${{$cartItem->product->offer_price}} </label>
                                </div>

                                <div class="col-md-2 col-7 my-auto">
                                    <div class="quantity">
                                        <div class="input-group">
                                            <button type="button" wire:loading.attr="disabled" wire:click="decrementQuantity( {{$cartItem->id}} )" class="btn btn1"><i class="fa fa-minus"></i></button>
                                            <input type="text" value="{{ $quantities[$cartItem->id] ?? 1 }}" readonly class="input-quantity" />
                                            <button type="button" wire:click="incrementQuantity( {{$cartItem->id}} )" class="btn btn1"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-1 my-auto">
                                    <label class="price">${{$cartItem->product->offer_price * $quantities[$cartItem->id] ?? 1}} </label>
                                    @php
                                        $totalPrice += $cartItem->product->offer_price * $quantities[$cartItem->id] ?? 1
                                    @endphp
                                </div>

                                <div class="col-md-2 col-5 my-auto">
                                    <div class="remove">
                                        <button type="button" wire:loading.attr="disabled" wire:click="removeCartItem( {{$cartItem->id}} )" class="btn btn-danger btn-sm">
                                            <span wire:loading.remove wire:click="removeCartItem( {{$cartItem->id}} )">
                                                <i class="fa fa-trash"></i> Remove
                                            </span>
                                            <span wire:loading wire:click="removeCartItem( {{$cartItem->id}} )">
                                                <i class="fa fa-trash"></i> Removing
                                            </span>
                                            
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                            
                        @empty
                            <div> No Cart Items Available!</div>
                        @endforelse
                           
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 mt-4">
                    <h5>Get the Best Deals & Offers <a href="{{url('/collections')}}">Shop now</a></h5>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="shadow-sm bg-white p-3">
                        <h4>Total:
                            <span> {{$totalPrice}} </span>
                        </h4>
                        <hr>
                        <a href="{{url ('/checkout')}}" class="btn btn-warning w-100"> Checkout</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
