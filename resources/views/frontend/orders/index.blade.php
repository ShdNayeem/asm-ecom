@extends('layouts.app')
@section('title', 'My Orders')
@section('content')

    <div class="py3 pyt-md-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4 class="fw-bold text-primary">My Orders</h4>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Tracking No</th>
                                        <th>User Name</th>
                                        <th>Payment Mode</th>
                                        <th>Ordered Date</th>
                                        <th>Status Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @forelse ($orders as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->tracking_no}}</td>
                                        <td>{{$order->fullname}}</td>
                                        <td>{{$order->payment_mode}}</td>
                                        <td>{{$order->created_at->format('d-m-y')}}</td>
                                        <td>{{$order->status_message}}</td>
                                        <td><a href="{{url ('/orders/'.$order->id) }}" class="btn btn-sm" style="background-color: #2874f0; color:white;"> View</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7"> No Orders Available!</td>
                                    </tr>
                                @endforelse
                                    
                                <tbody>

                                </tbody>
                            </table>
                            
                            <div>
                                {{$orders->links('pagination::bootstrap-5')}}
                            </div>
                            
                        </div>
                    </div>
                </div>
    
            </div>
        </div>
    </div>

@endsection