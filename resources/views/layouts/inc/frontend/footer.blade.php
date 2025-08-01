<div>
        <div class="footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                        <h5 class="footer-heading text-white fw-semibold">{{ $appSetting->website_name ?? '' }}</h5>
                        <div class="footer-underline mb-2"></div>
                        <p class="text-light small mt-3">
                            {{ $appSetting->page_title ?? '' }}
                        </p>
                        
                        <h5 class="footer-heading text-white fw-semibold mt-4">Social Media</h5>
                        <div class="footer-underline mb-2"></div>
                        <div class="social-media d-flex align-items-center flex-wrap gap-2 mt-3">
                            @if ($appSetting->instagram)
                                <a href="{{ $appSetting->instagram }}" target="_blank">
                                    <i class="fab fa-instagram text-white fs-5 me-1"></i>
                                </a>
                            @endif
                            @if ($appSetting->facebook)
                                <a href="{{ $appSetting->facebook }}" target="_blank">
                                    <i class="fab fa-facebook-f text-white fs-5 me-1"></i>
                                </a>
                            @endif
                            @if ($appSetting->twitter)
                                <a href="{{ $appSetting->twitter }}" target="_blank">
                                    <i class="fab fa-x-twitter text-white fs-5 me-1"></i>
                                </a>
                            @endif
                            @if ($appSetting->youtube)
                                <a href="{{ $appSetting->youtube }}" target="_blank">
                                    <i class="fab fa-youtube text-white fs-5 me-1"></i>
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-3">
                        <h4 class="footer-heading">Quick Links</h4>
                        <div class="footer-underline"></div>
                        <div class="mb-2"><a href="{{url ('/') }}" class="text-white">Home</a></div>
                        <div class="mb-2"><a href="{{url ('/about') }}" class="text-white">About Us</a></div>
                        <div class="mb-2"><a href="{{url ('/contact') }}" class="text-white">Contact Us</a></div>
                    </div>
                    <div class="col-md-3">
                        <h4 class="footer-heading">Shop Now</h4>
                        <div class="footer-underline"></div>
                        <div class="mb-2"><a href="{{url ('/collections') }}" class="text-white">Collections</a></div>
                        <div class="mb-2"><a href="{{url ('/newArrivals') }}" class="text-white">New Arrivals</a></div>
                        <div class="mb-2"><a href="{{url ('/cart') }}" class="text-white">Cart</a></div>
                        <div class="mb-2"><a href="{{url ('/wishlist') }}" class="text-white">Wishlist</a></div>
                    </div>
                    <div class="col-md-3">
                        <h4 class="footer-heading">Reach Us</h4>
                        <div class="footer-underline"></div>
                        <div>
                            <p>
                                <i class="fa fa-map-marker-alt me-1"></i> {{ $appSetting->address ?? '' }}
                            </p>
                        </div>
                        <div class="mb-2">
                            <a href="" class="text-white">
                                <i class="fa fa-phone me-1"></i> {{ $appSetting->phone1 ?? ''  }}
                            </a>
                        </div>
                        <div class="mb-2">
                            <a href="" class="text-white">
                                <i class="fa fa-envelope me-1"></i> {{ $appSetting->email1 ?? ''  }}
                            </a>
                        </div>
                        <div class="mb-2">
                            <a href="https://asminfotech.in/" target="_blank" class="text-white">
                                <i class="fa fa-globe me-1"></i> {{ $appSetting->website_url ?? ''  }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-area bg-light">
            <div class="container">
                <div class="row">
                    <div class="text-center">
                        <div>
                            <p class="text-dark ms-5 mt-2 mb-2">© 2025 Copyright <span class="fw-bold">ASM Ecom.</span> All Rights Reserved</p>
                        </div>
                        <div>
                            <p class="ms-5 text-dark mb-2">Powered by <a href="{{ $appSetting->website_url ?? ''  }}" class="text-decoration-none text-primary fw-semibold" target="_blank"> ASM Infotech</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>