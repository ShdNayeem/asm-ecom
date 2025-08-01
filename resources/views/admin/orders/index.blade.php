@extends('layouts.admin')
@section('title', 'My Orders')
@section('content')

    <div class="card">
                    <div class="card-header d-flex justify-content-between p-3">
                        <h2 class="fw-semibold text-secondary">All Orders</h2>
                    </div>
                    <div class="card-body">

                        <form action="" method="get">
                            <div class="row mb-4">
                                <div class="col-md-3">
                                <label  class="mb-2"> Filter by Date</label>
                                <input type="date" name="date" value="{{ Request::get('date') }}" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <label class="mb-2"> Filter by Status</label>
                                <select name="status" class="form-select">
                                    <option value="" class="text-dark">Select all Status</option>
                                    <option value="in progress" class="text-dark" {{ Request::get('status') == 'in progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed" class="text-dark" {{ Request::get('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                    <option value="pending" class="text-dark" {{ Request::get('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="canceled" class="text-dark" {{ Request::get('status') == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                    <option value="out-for-delivery" class="text-dark" {{ Request::get('status') == 'out-for-delivery' ? 'selected' : '' }}>Out for Delivery</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-2">
                                <br/>
                                <button type="submit" class="btn btn-info me-2"> Filter </button>
                            </div>
                            
                        </div>
                        <hr>                        
                    </form>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="fw-bold">Order ID</th>
                                        <th class="fw-bold">Tracking No</th>
                                        <th class="fw-bold">User Name</th>
                                        <th class="fw-bold">Payment Mode</th>
                                        <th class="fw-bold">Ordered Date</th>
                                        <th class="fw-bold">Status Message</th>
                                        <th class="fw-bold">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->tracking_no}}</td>
                                            <td>{{$order->fullname}}</td>
                                            <td>{{$order->payment_mode}}</td>
                                            <td>{{$order->created_at->format('d-m-y')}}</td>
                                            <td>{{$order->status_message}}</td>
                                            <td><a href="{{url ('admin/orders/'.$order->id) }}" class="btn btn-info btn-sm"> View</a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7"> No Orders Available!</td>
                                        </tr>
                                    @endforelse
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