<div>
    <div class="py-3 py-md-5 bg-light">

        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="bg-white border" wire:ignore>
                        @if ($product->productImages)
                            <div class="exzoom" id="exzoom">
                            <div class="exzoom_img_box">
                                <ul class='exzoom_img_ul'>
                                   @foreach ($product->productImages as $itemImg)
                                       <li><img src="{{ asset($itemImg->image) }}"/></li>   
                                   @endforeach
                                </ul>
                            </div>
                            <div class="exzoom_nav"></div>
                                <p class="exzoom_btn">
                                    <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                                    <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                                </p>
                            </div>
                        
                        @else
                            No Image Added
                        @endif

                         
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
                            <p id="msme">MSME No : <strong>{{$product->msme_no}}</strong></p>
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
                            @php
                                $inCart = in_array($product->id, $cartProductIds ?? []);
                            @endphp
                            <button type="button" wire:click="addToCart({{ $product->id }})" class="btn btn1" @if($inCart) disabled @endif>
                                <i class="fa {{ $inCart ? 'fa-check' : 'fa-shopping-cart' }}"></i> 
                                {{ $inCart ? 'Added' : 'Add To Cart' }}
                            </button>
                            <button type="button" wire:click="addToWishList( {{$product->id}} )" class="btn btn1">
                                <span wire:loading.remove wire:target="addToWishList">
                                    <i class="fa fa-heart"></i> Add To Wishlist 
                                </span>
                                <span wire:loading wire:target="addToWishList">Adding...</span>
                            </button>
                        </div>

                        <!-- <script>
                            function changeButtonText(button) {
                                button.innerHTML = '<i class="fa fa-check"></i> Added';
                                button.disabled = true;
                            }
                        </script> -->
                    </div>
                </div>
            </div>
             
        </div>
    </div>

    <div class="py-3 py-md-5 bg-white">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3>Related
                        @if ($product->category) {{$product->category->name}} @endif
                        Products</h3>
                    <div class="underline"></div>
                </div>

                @forelse ($product->category->relatedProducts as $relatedProduct)
                    <div class="col-md-3">
                        <div class="product-card">
                                    <div class="product-card-img">
                                        <a href="{{url('/collections/'.$relatedProduct->category->slug.'/'.$relatedProduct->slug)}}">
                                            <img src="{{ asset($relatedProduct->productImages[0]->image) }}" alt="{{ $relatedProduct->name }}">
                                        </a>
                                        
                                    </div>
                                    <div class="product-card-body">
                                        <div class="mb-2">

                                            <span class="original-price">${{$relatedProduct->price}}</span>
                                            <span class="selling-price">${{$relatedProduct->offer_price}}</span>
                                        </div>
                                        <h5 class="product-name">
                                        <a href="{{url('/collections/'.$relatedProduct->category->slug.'/'.$relatedProduct->slug)}}">
                                                {{$relatedProduct->name}} 
                                        </a>
                                        </h5>
                                    </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12 p-2">
                        <h4>No Products Available</h4>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

</div>

@push('scripts')
    <script>
$(function(){
  $("#exzoom").exzoom({
    "navWidth": 60,
    "navHeight": 60,
    "navItemNum": 5,
    "navItemMargin": 7,
    "navBorder": 1,
    "autoPlay":false,
    "autoPlayTimeout": 2000
  });
});

    </script>
@endpush