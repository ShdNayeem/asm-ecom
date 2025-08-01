<div>
    <div class="py-3 py-md-5 bg-light">
        
        <div class="container">
    
            <div class="row">
                <div class="col-md-12">
                    <h4 class="fw-bold text-primary">Your Wishlist</h4>
                    <hr>
                    <div class="shopping-cart">
                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Price</h4>
                                </div>
                                <!-- <div class="col-md-2">
                                    <h4>Quantity</h4>
                                </div> -->
                                <div class="col-md-2">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>
                        @forelse ($wishlist as $wishlistItem)
                            <div class="cart-item">
                            <div class="row">
                                <div class="col-md-6 my-auto">

                                    <a href="{{ url ('collections/'.$wishlistItem->product->category->slug.'/'.$wishlistItem->product->slug )}}">
                                        <label class="product-name">
                                            <img src="{{asset($wishlistItem->product->productImages->first()->image)}}" style="width: 50px; height: 50px" alt="{{$wishlistItem->product->name}}">
                                            {{$wishlistItem->product->name}}
                                        </label>
                                    </a>
                                </div>
                                <div class="col-md-2 my-auto">
                                    <label class="price">${{$wishlistItem->product->offer_price}} </label>
                                </div>

                                <!-- <div class="col-md-2 col-7 my-auto">
                                    <div class="quantity">
                                        <div class="input-group">
                                            <span class="btn btn1"><i class="fa fa-minus"></i></span>
                                            <input type="text" value="1" class="input-quantity" />
                                            <span class="btn btn1"><i class="fa fa-plus"></i></span>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="col-md-2 col-5 my-auto">
                                    <div class="remove">
                                        <button type="button" wire:click="removeWishlistItem( {{$wishlistItem->id}} )" class="btn btn-danger btn-sm">
                                            <span wire:loading.remove wire.target ="removeWishlistItem( {{$wishlistItem->id}} )">
                                                <i class="fa fa-trash me-1"></i> Remove
                                            </span>
                                            <span wire:loading wire.target ="removeWishlistItem( {{$wishlistItem->id}} )">
                                                <i class="fa fa-trash me-1"></i> Removing
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                            
                            <!-- <p class="text-center mt-5">No Wishlist Added!</p>
                            <div class="d-flex justify-content-center">
                                <a href="{{ url('/category') }}" class="btn btn-warning mt-2 w-25">Shop Now</a>
                            </div> -->

                            <div class="card card-body text-center p-md-5 mt-3 shadow">
                                <h5>No Wishlist Added!</h5>
                                <div class="d-flex justify-content-center">
                                    <a href="{{url ('/collections') }}" class="btn btn-warning w-25 mt-3">Shop now</a>
                                </div>
                            </div>
                            
                        @endforelse
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
