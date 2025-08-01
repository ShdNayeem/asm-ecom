<div>
    <div class="py-3 py-md-5">
        <div class="container">
            <div class="d-flex justify-content-between mt-3">
                <h4>My Cart</h4>
                    <button type="button" data-bs-dismiss="offcanvas" class="btn btn-close"></button>
                </div>
                <hr>
            
                @if (Auth::check())
                    <div class="row">
                    <div class="col-md-12">
                        <div class="shopping-cart">
                            @forelse ($cart as $cartItem)
                            @if ($cartItem->product)
                                <div class="cart-item">
                                    <div class="row">
                                        <div class="col-md-6 my-auto">
                                            
                                            <label class="price mb-2">${{$cartItem->product->offer_price}} </label>

                                            <a href="{{ url ('collections/'.$cartItem->product->category->slug.'/'.$cartItem->product->slug )}}">
                                            <label class="product-name">

                                                @if ($cartItem->product->productImages->first())
                                                    <img src="{{ asset($cartItem->product->productImages->first()->image) }}" style="width: 50px; height: 50px" alt="">
                                                @else
                                                    <img src="" style="width: 50px; height: 50px" alt="">
                                                @endif
                                                <br>
                                                    {{$cartItem->product->name}}
                                            </label>
                                            </a>
                                        </div>

                                    <!-- <div class="col-md-1 my-auto">
                                        <label class="price">${{$cartItem->product->offer_price}} </label>
                                    </div> -->

                                    <div class="col-md-4 col-7 my-auto">
                                        <div class="input-group input-group-sm">
                                            <button type="button" wire:loading.attr="disabled" wire:click="decrementQuantity({{ $cartItem->id }})" class="btn btn-outline-secondary">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                            <input type="text" class="form-control text-center" value="{{ $cartItem->quantity }}" readonly>
                                            <button type="button" wire:click="incrementQuantity({{ $cartItem->id }})" class="btn btn-outline-secondary">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="col-md-2 col-3 my-auto d-flex justify-content-center">
                                        <button type="button" wire:loading.attr="disabled" wire:click="removeCartItem({{ $cartItem->id }})" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </div>

                                    <div class="col-md-1 my-auto">
                                        <!-- <label class="price">${{$cartItem->product->offer_price * $cartItem->quantity}} </label> -->
                                        @php
                                            $totalPrice += $cartItem->product->offer_price * $cartItem->quantity
                                        @endphp
                                    </div>

                                </div>
                            </div>
                            @endif
                                
                            @empty
                                <div class="text-center"> No Cart Items Available!</div>
                            @endforelse 
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-md-12">
                            <div class="shopping-cart">
                                @if (session('cart'))
                                    @foreach (session('cart') as $productId => $details)
                                        <div class="cart-item">
                                            <div class="row">
                                                <div class="col-md-6 my-auto">
                                                    <label class="price mb-1">
                                                        ${{$details['price']}}
                                                    </label>
                                                    <br>
                                                    <div class="unauth">
                                                        <label class="product-name">
                                                            <a href="{{ url('collections/'.$details['category_slug'].'/'.$details['slug']) }}">
                                                                <img class="my-2" src="{{ $details['image'] }}" style="width: 50px; height: 50px"  alt="">
                                                                <br>
                                                                {{$details['name']}}
                                                            </a>
                                                        
                                                        </label>
                                                    </div>    
                                                </div>

                                                <div class="col-md-4 col-7 my-auto">
                                                    <div class="input-group input-group-sm">
                                                        <button type="button" wire:click="decrementGuestQuantity({{ $productId }})"  class="btn btn-outline-secondary">
                                                            <i class="fa fa-minus"></i>
                                                        </button>
                                                        <input type="text" class="form-control text-center" value="{{$details['quantity']}}" readonly>
                                                        <button type="button" wire:click="incrementGuestQuantity({{ $productId }})" class="btn btn-outline-secondary">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="col-md-2 col-3 my-auto d-flex justify-content-center">
                                                    <button type="button" wire:loading.attr="disabled"  wire:click="removeGuestCartItem( {{ $productId }})" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </div>

                                                <div class="col-md-6 mt-1 my-auto">
                                                    <label class="price mb-1"> Total : ${{$details['price'] * $details['quantity']}}</label>
                                                </div>

                                                <div class="col-md-1 my-auto"> 
                                                    @php
                                                        $totalPrice += $details['price'] * $details['quantity']
                                                    @endphp
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-center"> No Cart Items Available!</div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
                
            </div>

            <div class="row">
                <div class=" mt-3">
                    <div class="shadow-sm bg-white p-3">
                        <h4>Total Amount :
                            <span> ${{$totalPrice}} </span>
                        </h4>
                        <hr>
                        <a href="{{url('/checkout')}}" class="btn btn-warning w-100 mt-1">Checkout</a>
                        <a href="{{url('/cart')}}" class="btn btn-primary w-100 mt-3">View Shopping Cart</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>
