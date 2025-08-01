@extends('layouts.app')
@section('title', 'My Order Detail')
@section('content')

    <div class="py3 pyt-md-4">
        <div class="container">

        @if (session('message'))
            <div class="d-flex justify-content-center">
                <div class="alert alert-success alert-dismissible fade show shadow rounded-3 px-4 py-3 col-md-6 text-center">
                    <span><strong>Success</strong></span> {{ session('message') }}
                </div>
            </div>
        @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">

                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <h4 class="text-primary mb-2 mb-md-0 fw-bold">
                                <i class="fa fa-shopping-cart text-primary"></i> Order Details
                            </h4>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ url('/orders') }}" class="btn btn-danger btn-sm">
                                    <i class="fa fa-arrow-left me-1"></i> Back
                                </a>
                                <a href="{{ url('/invoice/'.$order->id.'/generate') }}" class="btn btn-success btn-sm">
                                    <i class="fa fa-download me-1"></i> Download Invoice
                                </a>
                                <a href="{{ url('/invoice/'.$order->id) }}" target="_blank" class="text-white btn btn-sm" style="background-color:goldenrod;">
                                    <i class="fa fa-print me-1"></i> Print
                                </a>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="fw-bold text-muted"> Order Details</h5>
                                <hr>
                                <h6> <strong>Order Id : </strong> {{$order->id}}</h6>
                                <h6><strong>Tracking Id/No : </strong> {{$order->tracking_no}}</h6>
                                <h6><strong>Order Created Date : </strong> {{$order->created_at->format('d-m-Y h:i A')}}</h6>
                                <h6><strong>Payment Mode : </strong> {{$order->payment_mode}}</h6>
                                <h6>
                                    <strong>Payment Id : </strong>
                                    @if ($order->payment_id)
                                        {{$order->payment_id}}
                                    @else
                                        COD Order
                                    @endif
                                </h6>
                                <h6 class="border p-2 text-success">
                                    <strong>Order Status Message :</strong> <span class="text-uppercase">  {{$order->status_message}}</span>
                                </h6>
                            </div>

                            <div class="col-md-6">
                                <h5 class="fw-bold text-muted"> User Details</h5>
                                <hr>
                                <h6><strong>Full Name : </strong> {{$order->fullname}} </h6>
                                <h6><strong>Email Id : </strong> {{$order->email}} </h6>
                                <h6><strong>Phone : </strong> {{$order->phone}} </h6>
                                <h6><strong>Address : </strong> {{$order->address}} </h6>
                                <h6><strong>Pincode : </strong> {{$order->pincode}} </h6>
                            </div>
                        </div>
                        <br/>
                        
                        <h5 class="fw-bold text-muted">Order Items</h5>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Item ID</th>
                                        <th>Image</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $totalPrice = 0; @endphp

                                    @foreach ($order->orderItems as $orderItem)
                                        @php
                                            $itemTotal = $orderItem->price * $orderItem->quantity;
                                            $totalPrice += $itemTotal;
                                        @endphp
                                        <tr>
                                            <td width="10%">{{ $orderItem->id }}</td>
                                            <td width="10%">
                                                @if ($orderItem->product->productImages->first())
                                                    <img src="{{ asset($orderItem->product->productImages->first()->image) }}" style="width: 50px; height: 50px" alt="">
                                                @else
                                                    <img src="{{ asset('images/no-image.png') }}" style="width: 50px; height: 50px" alt="">
                                                @endif
                                            </td>
                                            <td>{{ $orderItem->product->name }}</td>
                                            <td width="10%">${{ number_format($orderItem->price, 2) }}</td>
                                            <td width="10%">{{ $orderItem->quantity }}</td>
                                            <td width="10%" class="fw-bold">${{ number_format($itemTotal, 2) }}</td>
                                        </tr>
                                    @endforeach

                                    <!-- Subtotal -->
                                    <tr>
                                        <td colspan="5" class="fw-bold text-end">Subtotal:</td>
                                        <td class="fw-bold">${{ number_format($totalPrice, 2) }}</td>
                                    </tr>

                                    <!-- Discount -->
                                    @if ($order->discount > 0)
                                        <tr>
                                            <td colspan="5" class="fw-bold text-success text-end">
                                                Discount 
                                                @if ($order->coupon_code)
                                                    (Coupon: <span>{{ $order->coupon_code }}</span>)
                                                @endif:
                                            </td>
                                            <td class="fw-bold text-success">- ${{ number_format($order->discount, 2) }}</td>
                                        </tr>
                                    @endif

                                    <!-- Final Total -->
                                    <tr>
                                        <td colspan="5" class="fw-bold text-end">Total Paid:</td>
                                        <td class="fw-bold">${{ number_format($order->final_amount ?? $totalPrice, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
