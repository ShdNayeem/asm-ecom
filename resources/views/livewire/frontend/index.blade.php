<div>
    <div id="carouselExampleCaptions" class="carousel slide">
                @if (session('message'))
                    <div class="d-flex justify-content-center">
                        <div class="alert alert-success alert-dismissible fade show shadow rounded-3 px-4 py-3 col-md-6 text-center">
                            <span><strong>Success</strong></span> {{ session('message') }}
                        </div>
                    </div>
                @endif
                @if (session('status'))
                    <div class="d-flex justify-content-center">
                        <div class="alert alert-warning alert-dismissible fade show shadow rounded-3 px-4 py-3 col-md-6 text-center" role="alert">
                            <i class="fa fa-exclamation-circle me-2"></i>
                            <strong>Notice: </strong> {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
        <div class="carousel-inner">

            @foreach ($sliders as $slider)
                <div class="carousel-item active">
                    @if ($slider->image)
                    <img src="{{ asset($slider->image) }}" style="height: 500px;" class="d-block w-100" alt="Slider Image">
                    @endif

                    <!-- <div class="carousel-caption d-none d-md-block">
                        <h5>{{$slider->title}}</h5>
                        <p>{{$slider->description}}</p>
                    </div> -->
                    <div class="carousel-caption d-none d-md-block">
                        <div class="custom-carousel-content">
                            <h1 style="color: #192941ff";>
                                {{$slider->title}}
                            </h1>
                            <p class="fw-semibold" style="color: #294268ff;">
                                {{$slider->description}}
                            </p>
                            <div>
                                <a href="{{url('/about')}}" class="btn btn-slider">
                                    Read more
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h3 class="fw-bold"> Welcome to ASM Ecom</h3>
                    <div class="underline"> </div>
                    <p class="fw-bold" style="color: #294268ff;">
                        ASM Ecom Founded in 2010, our company has been committed to delivering excellence in every project we undertake. 
                        Our journey began with a vision to simplify technology and improve lives through innovative solutions. 
                        Today, we proudly serve thousands of customers around the globe.
                    </p>

                    <p class="text-secondary fw-semibold mt-4">
                    With a focus on quality, integrity, and customer satisfaction, we continue to grow and evolve with the changing landscape of business and technology. Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-between">
                    <span>
                        <h4>New Arrivals</h4>
                        <div class="underline mb-4"></div>
                    </span>
                    <div class="text-center">
                        <a href="{{url ('/collections')}}" class="btn btn-warning">View more</a>
                    </div>
                    
                </div>

                    @if ($newArrivals)
                        @foreach ($newArrivals as $newArrival)
                        <div class="col-md-3">
                            <div class="product-card">
                                <div class="product-card-img">
                                    <a href="{{url('/collections/'.$newArrival->category->slug.'/'.$newArrival->slug)}}">
                                        <img src="{{ asset($newArrival->productImages[0]->image) }}" alt="{{ $newArrival->name }}">
                                    </a>   
                                </div>
                                <div class="product-card-body">
                                    <div class="mb-2">
                                        <span class="original-price">${{$newArrival->price}}</span>
                                        <span class="selling-price">${{$newArrival->offer_price}}</span>
                                    </div>
                                    <h5 class="product-name">
                                        <a href="{{url('/collections/'.$newArrival->category->slug.'/'.$newArrival->slug)}}">
                                            {{$newArrival->name}} 
                                        </a>
                                    </h5>
                                    @php
                                    $inCart = in_array($newArrival->id, $cartProductIds ?? []);
                                    @endphp
                                    <button type="button" wire:click="addToCart({{ $newArrival->id }})" class="btn btn1" @if($inCart) disabled @endif>
                                        <i class="fa {{ $inCart ? 'fa-check' : 'fa-shopping-cart' }}"></i> 
                                        {{ $inCart ? 'Added' : 'Add To Cart' }}
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
                    @endforeach
                    @else
                        <div class="col-md-12 p-2">
                            <h4>No Products Available</h4>
                        </div>
                    @endif
            </div>
        </div>
    </div>

    <div class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-between">
                    <span>
                        <h4>Latest {{ ucfirst($mobileCategory->name) }} Products</h4>
                        <div class="underline mb-4"></div>
                    </span>
                    <div class="text-center">
                        <a href="{{url ('/collections/mobile')}}" class="btn btn-warning">View more</a>
                    </div>
                    
                </div>

                   @if ($mobileProducts && count($mobileProducts) > 0)
                        @foreach ($mobileProducts as $mobile)
                            <div class="col-md-3">
                                <div class="product-card">
                                    <div class="product-card-img">
                                        <a href="{{ url('/collections/' . $mobile->category->slug . '/' . $mobile->slug) }}">
                                            <img src="{{ asset($mobile->productImages[0]->image) }}" alt="{{ $mobile->name }}">
                                        </a>
                                    </div>
                                    <div class="product-card-body">
                                        <div class="mb-2">
                                            <span class="original-price">${{ $mobile->price }}</span>
                                            <span class="selling-price">${{ $mobile->offer_price }}</span>
                                        </div>
                                        <h5 class="product-name">
                                            <a href="{{ url('/collections/' . $mobile->category->slug . '/' . $mobile->slug) }}">
                                                {{ $mobile->name }}
                                            </a>
                                        </h5>
                                        @php
                                            $inCart = in_array($mobile->id, $cartProductIds ?? []);
                                        @endphp
                                        <button type="button" wire:click="addToCart({{ $mobile->id }})" class="btn btn1" @if($inCart) disabled @endif>
                                            <i class="fa {{ $inCart ? 'fa-check' : 'fa-shopping-cart' }}"></i>
                                            {{ $inCart ? 'Added' : 'Add To Cart' }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-md-12 p-2">
                            <h4>No Mobile Products Available</h4>
                        </div>
                    @endif
            </div>
        </div>
    </div>
</div>

<!-- Off Canvas For Cart Show -->


