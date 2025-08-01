    <div class="py-3 py-md- checkout">
        <div class="container">

                <!-- Razorpay Alert messages -->
                @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Razorpay Alert messages -->
            @if (session('payment'))
                <div class="card mt-3">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Payment Details</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Payment ID:</strong> {{ session('payment')->payment_id }}</p>
                        <p><strong>Amount:</strong> ₹{{ session('payment')->totalProductAmount }}</p>
                    </div>
                </div>
            @endif

            <div class="checkout-details">
                <h4 class="fw-bold text-primary">Checkout</h4>
                <hr>

                @if ($this->totalProductAmount != 0)
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="shadow bg-white p-3">
                                <h4 class="text-primary">
                                    Total Amount :
                                    <span class="float-end">
                                        @if ($discount && $discount > 0)
                                            ${{ number_format($totalProductAmount - $discount, 2) }}
                                        @else
                                            ${{number_format($this->totalProductAmount, 2)}}
                                        @endif
                                    </span>
                                </h4>
                                <hr>
                                <small>* Items will be delivered in 3 - 5 days.</small>
                                <br/>
                                <small>* Tax and other charges are included.</small>
                                
                                <h4 class="text-primary mt-3">
                                    User Details
                                </h4>
                                <hr>

                                <form action="{{ route('razorpay.payment') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>Full Name</label>
                                            <input type="text" name="fullname" wire:model.defer="fullname" class="form-control" placeholder="Enter Full Name" />
                                            @error('fullname')
                                                <small class="text-danger"> {{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label>Phone Number</label>
                                            <input type="number" name="phone" wire:model.defer="phone" class="form-control" maxlength="10" placeholder="Enter Phone Number" />
                                            @error('phone')
                                                <small class="text-danger"> {{$message}} </small>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label>Email Address</label>
                                            <input type="email" name="email" wire:model.defer="email"  class="form-control" placeholder="Enter Email Address" />
                                            @error('email')
                                                <small class="text-danger"> {{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label>Pin-code (Zip-code)</label>
                                            <input type="number" name="pincode" wire:model.defer="pincode" class="form-control" placeholder="Enter Pin-code" />
                                            @error('pincode')
                                                <small class="text-danger"> {{$message}}</small>
                                            @enderror
                                        </div>

                                        <div class="col-md-12 mb-3">
                                            <label>Address</label>
                                            <textarea wire:model.defer="address" name="address" class="form-control" rows="2"></textarea>
                                            @error('address')
                                                <small class="text-danger"> {{$message}}</small>
                                            @enderror
                                        </div>
                                        

                                        <div class="col-md-12 mb-3">
                                            <label>Select Payment Mode: </label>
                                            <div class="d-md-flex align-items-start">
                                                <div class="nav col-md-3 flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                    <button wire:loading.attr="disabled" class="nav-link active fw-bold" id="cashOnDeliveryTab-tab" data-bs-toggle="pill" data-bs-target="#cashOnDeliveryTab" type="button" role="tab" aria-controls="cashOnDeliveryTab" aria-selected="true">Cash on Delivery</button>
                                                    <button wire:loading.attr="disabled" class="nav-link fw-bold" id="onlinePayment-tab" data-bs-toggle="pill" data-bs-target="#onlinePayment" type="button" role="tab" aria-controls="onlinePayment" aria-selected="false">Online Payment</button>
                                                </div>

                                                <div class="tab-content col-md-9" id="v-pills-tabContent">
                                                    <div class="tab-pane active show fade" id="cashOnDeliveryTab" role="tabpanel" aria-labelledby="cashOnDeliveryTab-tab" tabindex="0">
                                                        <h6>Cash on Delivery Mode</h6>
                                                        <hr/>
                                                        <button type="button" wire:loading.attr="disabled" wire:click="codOrder" class="btn btn-primary">
                                                            <span wire:loading.remove wire:target="codOrder">
                                                                Place Order (Cash on Delivery)
                                                            </span>
                                                            <span wire:loading wire:target="codOrder">
                                                                Placing Order
                                                            </span>
                                                        </button>
                                                    </div>

                                                    <div class="tab-pane fade" id="onlinePayment" role="tabpanel" aria-labelledby="onlinePayment-tab" tabindex="0">
                                                    <h6>Online Payment Mode</h6>
                                                    <hr />
                                                    <button type="submit" wire:loading.attr="disabled" class="btn btn-warning">
                                                        Pay Now (Online Payment)
                                                    </button>
                                                </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                            
                        </div>

                        <div class="col-md-6 mb-4">
                            <div class="mt-3">
                                <h4 class="text-primary">Product Details</h4>
                                <hr>
                            </div>

                                <div class="shopping-cart">
                                    @foreach ($cartProducts as $cartItem)
                                        @if ($cartItem->product)
                                            <div class="cart-item mb-3">
                                                <div class="row">
                                                    <div class="col-md-6 my-auto">
                                                        <div class="d-flex gap-5">
                                                            <div>
                                                                <label class="product-name">
                                                                    @if ($cartItem->product->productImages->first()->image)
                                                                        <img src="{{ asset($cartItem->product->productImages->first()->image) }}" style="width: 110px; height: 100px" alt="">
                                                                    @else
                                                                        <img src="" style="width: 50px; height: 50px" alt="">
                                                                    @endif
                                                                    <br>
                                                                </label>
                                                            </div>

                                                            <div>
                                                                <label class="product-name">
                                                                    <span class="text-secondary">Name :</span> {{ $cartItem->product->name }}
                                                                </label>

                                                                <label class="product-name">
                                                                    <span class="text-secondary">Price :</span> ${{ number_format($cartItem->product->offer_price, 2) }}
                                                                </label>

                                                                <label class="product-name">
                                                                    <span class="text-secondary">Quantity :</span> {{$cartItem->quantity}}
                                                                </label>

                                                                <label class="product-name">
                                                                    <span class="text-secondary">Total :</span> ${{number_format($cartItem->quantity * $cartItem->product->offer_price, 2)}}
                                                                </label>

                                                                <div class="col-md-1 my-auto"> 
                                                                    @php
                                                                        $totalPrice += $cartItem->product->offer_price * $cartItem->quantity
                                                                    @endphp
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                    <div class="mt-3">
                                        {{-- Livewire feedback messages --}}
                                        @if ($message)
                                            <div class="alert alert-success mt-2 col-md-8"><i class="fas fa-check-circle text-success me-2"></i><strong>{{ $appliedCoupon }}</strong> - {{ $message }}</div>
                                        @endif
                                        @if ($error)
                                            <div class="alert alert-danger mt-2 col-md-8"><i class="fas fa-exclamation-triangle text-danger me-2"></i>{{ $error }}</div>
                                        @endif

                            <div class="shadow bg-white p-4 px-md-5 d-flex flex-column flex-md-row justify-content-between align-items-start gap-5">
                                
                                <div class="w-100 w-md-50">
                                    <h4 class="text-primary">Discount Code :</h4>
                                    <hr>
                                    <form wire:submit.prevent="applyCoupon">
                                        <input type="text" wire:model="coupon_code" class="form-control @error('coupon_code') is-invalid @enderror" placeholder="Enter Coupon code">
                                        @error('coupon_code')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror

                                        <button type="submit" class="btn btn-success mt-3 btn-sm px-3">Apply</button>

                                        @if ($appliedCoupon)
                                        <button type="button" class="btn btn-danger btn-sm mt-3" wire:click="clearCoupon">
                                            Remove Coupon
                                        </button>
                                        @endif
                                    </form>
                                </div>

                                <div class="w-100 w-md-50">
                                    <h4 class="text-primary">Total Amount :</h4>
                                    <hr>

                                    @if ($discount && $discount > 0)
                                        <p>
                                            <span class="text-muted fw-semibold">Original:</span> <span class="fw-bold text-danger float-end"><del>${{ number_format($totalPrice, 2) }}</del></span><br>
                                            <span class="text-muted fw-semibold">Discount: </span> <span class="text-success fw-bold float-end">-${{ number_format($discount, 2) }}</span>
                                        </p>
                                        <hr>
                                        <h4 class="text-primary">Payable Now: </span> <span class="text-dark float-end"> ${{ number_format($totalPrice - $discount, 2) }}</h4>
                                    @else
                                        <h4 class="text-dark">${{ number_format($totalPrice, 2) }}</h4>
                                    @endif
                                </div>
                            </div>
                        </div>                    
                    </div>
                </div>
                @else
                    <div class="card card-body shadow text-center p-md-5">
                        <h4>No Items in Cart to Check!</h4>
                        <div class="d-flex justify-content-center">
                            <a href="{{url ('/collections') }}" class="btn btn-warning w-50 mt-3">Shop now</a>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

