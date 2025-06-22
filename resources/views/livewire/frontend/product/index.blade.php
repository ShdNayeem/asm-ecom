<div>
    <div class="row">
        @forelse ($products as $product)
                <div class="col-md-3">
                    <div class="product-card">
                        <div class="product-card-img">
                            <a href="{{url('/collections/'.$product->category->slug.'/'.$product->slug)}}">
                                <img src="{{ asset($product->firstImage->image) }}" alt="{{ $product->name }}">
                            </a>
                            
                        </div>
                        <div class="product-card-body">
                             <div class="mb-2">

                                <span class="original-price">${{$product->price}}</span>
                                <span class="selling-price">${{$product->offer_price}}</span>
                            </div>
                            <h5 class="product-name">
                               <a href="{{url('/collections/'.$product->category->slug.'/'.$product->slug)}}">
                                    {{$product->name}} 
                               </a>
                            </h5>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-md-12">
                    <div class="p-2">
                        <h4>No Products Available for {{$category->name}}</h4>
                    </div>
                </div>
                @endforelse
    </div> 
</div>
