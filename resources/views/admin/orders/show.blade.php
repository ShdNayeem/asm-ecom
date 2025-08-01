@extends('layouts.admin')
@section('title', 'My Order Details')
@section('content')
<div class="row">
    <div class="col-md-12">

        @if (session('message'))
            <div class="d-flex justify-content-center">
                <div class="alert alert-success alert-dismissible fade show shadow rounded-3 px-4 py-3 col-md-6 text-center" role="alert">
                    <span class="me-2"><i class="bi bi-patch-check"></i></span>
                    <strong> Success: </strong> {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (session('error'))
           <div class="d-flex justify-content-center">
                <div class="alert alert-danger alert-dismissible fade show shadow rounded-3 px-4 py-3 col-md-6 text-center" role="alert">
                    <strong><strong class="me-2">!</strong>Notice: </strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif


        <div class="card">
                    <div class="card-header p-3">
                        <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-2">
                            <h2 class="mb-0 fw-semibold text-secondary">Order Details</h2>

                            <div class="d-flex flex-wrap gap-2 mt-2 mt-md-0">
                                <a href="{{ url('admin/orders') }}" class="btn btn-sm" style="background-color: red; color:white;">
                                    <i class="mdi mdi-arrow-left"></i> Back
                                </a>
                                <a href="{{ url('admin/invoice/' . $order->id . '/generate') }}" class="btn btn-sm" style="background-color: green; color:white;">
                                    <i class="bi bi-download me-1"></i> Download Invoice
                                </a>
                                <a href="{{ url('admin/invoice/' . $order->id) }}" target="_blank" class="btn btn-secondary btn-sm">
                                    <i class="bi bi-printer me-1"></i> Print
                                </a>
                                <a href="{{ url('admin/invoice/' . $order->id . '/mail') }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-send me-1"></i> Send Invoice via Email
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="fw-bold text-info mt-2"> Order Details</h4>
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
                                <h6 class="border p-2">
                                    <strong>Order Status Message :</strong> <span class="text-uppercase">
                                        @if ($order->status_message == 'completed')
                                            <span style="color: green;">{{$order->status_message}}</span>
                                        @elseif ($order->status_message == 'in progress')
                                            <span class="text-warning">{{$order->status_message}}</span>
                                        @elseif ($order->status_message == 'canceled')
                                            <span class="text-danger">{{$order->status_message}}</span>
                                        @elseif ($order->status_message == 'pending')
                                            <span class="text-secondary">{{$order->status_message}}</span>
                                        @elseif ($order->status_message == 'out-for-delivery')
                                            <span class="text-success">{{$order->status_message}}</span>
                                        @endif
                                    </span>
                                </h6>
                            </div>
                            
                            <div class="col-md-6">
                                <h4 class="fw-bold text-info mt-2"> User Details</h4>
                                <hr>
                                <h6><strong>Full Name : </strong> {{$order->fullname}} </h6>
                                <h6><strong>Email Id : </strong> {{$order->email}} </h6>
                                <h6><strong>Phone : </strong> {{$order->phone}} </h6>
                                <h6><strong>Address : </strong> {{$order->address}} </h6>
                                <h6><strong>Pincode : </strong> {{$order->pincode}} </h6>
                            </div>
                        </div>
                        <br/>
                        
                        <h4 class="fw-bold text-info mt-2">Order Items</h4>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="fw-bold">Item ID</th>
                                        <th class="fw-bold">Image</th>
                                        <th class="fw-bold">Product</th>
                                        <th class="fw-bold">Price</th>
                                        <th class="fw-bold">Quantity</th>
                                        <th class="fw-bold">Total</th>
                                    </tr>
                                </thead>
                                    
                                <tbody>
                                    @php
                                    $totalPrice=0;
                                    @endphp
                                    @foreach ($order->orderItems as $orderItem)
                                        <tr>
                                            <td width="10%">{{ $orderItem->id }}</td>
                                            <td width="10%">
                                                @if ($orderItem->product->productImages[0]->image)
                                                <img src="{{ asset($orderItem->product->productImages[0]->image) }}" style="width: 50px; height: 50px; border-radius:0;" alt="">
                                                @else
                                                    <img src="" style="width: 50px; height: 50px" alt="">
                                                @endif
                                                
                                            </td>
                                            <td>{{ $orderItem->product->name}}</td>
                                            <td width="10%">{{ $orderItem->price }}</td>
                                            <td width="10%">{{ $orderItem->quantity }}</td>
                                            <td width="10%" class="fw-bold">${{ $orderItem->quantity * $orderItem->price }}</td>
                                            @php
                                                $totalPrice += $orderItem->quantity * $orderItem->price
                                            @endphp
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5" class="fw-bold">Total Amount :</td>
                                        <td colspan="1" class="fw-bold">${{$totalPrice}}</td>
                                    </tr>
                                </tbody>
                            </table>
                            
                        </div>
                </div>
            </div>
        </div>

        <div class="card border mt-3">
            <div class="card-body">
                <h4>Order Process (Order Status Updates)</h4>
                <hr>
                <div class="row">
                    <div class="col-md-5">
                        @if ($errors->any())
                            <div class="alert alert-danger mb-3">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{url ('admin/orders/'.$order->id)}}" method="post">
                            @csrf
                            @method('put')

                            <label class="mb-2"> Select Order Status</label>
                            <div class="input-group">
                                <select name="order_status" class="form-select">
                                    <option value="" class="text-dark">Select Status</option>
                                    <option value="in progress" class="text-dark" {{ Request::get('status') == 'in progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" class="text-dark" {{ Request::get('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="pending" class="text-dark" {{ Request::get('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="canceled" class="text-dark" {{ Request::get('status') == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                    <option value="out-for-delivery" class="text-dark" {{ Request::get('status') == 'out-for-delivery' ? 'selected' : '' }}>Out for Delivery</option>
                                </select>
                                <button type="submit" class="btn btn-info ms-3">Update</button>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-7">
                        <br>
                        <h4 class="mt-3"> Order Status : <span class="text-uppercase">
                            @if ($order->status_message == 'completed')
                            <span class="fw-bold" style="color: green;">{{$order->status_message}}</span>
                                @elseif ($order->status_message == 'in progress')
                                    <span class="text-warning fw-bold">{{$order->status_message}}</span>
                                @elseif ($order->status_message == 'canceled')
                                    <span class="text-danger fw-bold">{{$order->status_message}}</span>
                                @elseif ($order->status_message == 'pending')
                                    <span class="text-secondary fw-bold">{{$order->status_message}}</span>
                                @elseif ($order->status_message == 'out-for-delivery')
                                    <span class="text-success fw-bold">{{$order->status_message}}</span>
                                @endif                                                   
                            </span>                
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    

@endsection