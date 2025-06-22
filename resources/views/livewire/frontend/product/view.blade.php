<div>
    <div class="py-3 py-md-5 bg-light">

        <div class="container">
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
            
            <div class="row">
                <div class="col-md-5">
                    <div class="bg-white border">
                        <img class="mt-5 ms-5" src="{{ asset($product->firstImage->image) }}" style="width: 400px; height:400px" alt="{{ $product->name }}">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="product-view">

                        
                        <!-- <p class="product-path">
                             
                        </p> -->
                        <div class="mb-1">
                            <span class="original-price">${{$product->price}}</span>
                            <span class="selling-price">${{$product->offer_price}}</span>
                        </div>
                        <hr>
                        <h4 class="product-name">
                            {{$product->name}}
                        </h4>
                        
                        
                        <div class="mt-2 mb-3">
                            <!-- <h5 class="mb-2">Description</h5> -->
                            <p>
                                {{$product->description}}
                            </p>
                        </div>

                        <div>
                            <p>MSME No : <strong>{{$product->msme_no}}</strong></p>
                            <p>Net Weight (Approx. When packed) : <strong>{{$product->net_weight}}</strong></p>
                            <p>Batch No : <strong>{{$product->batch_no}}</strong></p>
                            <p>MFG Date : <strong>{{$product->mfg_date}}</strong></p>
                            <p>M.R.P (Incl. all Tax) : <strong>{{ $product->mrp == 1 ? 'Yes' : 'No' }}</strong></p>
                            <p>U.S.P : <strong>{{$product->usp}}</strong></p>
                        </div>
                            
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click="decrementQuantity"><i class="fa fa-minus"></i></span>
                                <input type="text" wire:model="quantityCount" value="{{ $this->quantityCount }}" readonly class="input-quantity" />
                                <span class="btn btn1" wire:click="incrementQuantity"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" wire:click="addToCart( {{$product->id}} )" class="btn btn1">
                                <i class="fa fa-shopping-cart"></i> Add To Cart
                            </button>
                            <button type="button" wire:click="addToWishList( {{$product->id}} )" class="btn btn1">
                                <span wire:loading.remove wire:target="addToWishList">
                                    <i class="fa fa-heart"></i> Add To Wishlist 
                                </span>
                                <span wire:loading wire:target="addToWishList">Adding...</span>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Description</h4>
                        </div>
                        <div class="card-body">
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
