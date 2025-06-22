@extends('layouts.admin')
@section('content')
    
<div class="row">
            <div class="col-md-12 grid-margin">
                @if (session('message'))
                    <p class="alert alert-success"> {{session('message')}}</p>
                @endif
                <div class="card">
                    <div class="card-header d-flex justify-content-between p-3">
                        <a href="{{url('admin/offers')}}" class="text-decoration-none text-dark"><h2>Offers</h2></a>
                        <a href="{{url('admin/offers/create')}}" class="btn btn-primary"> Add Offer</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <div class="thead">
                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </div>

                            <div class="tbody">
                                @foreach ($offers as $offer)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$offer->product_name}}</td>
                                        <td>{{$offer->description}}</td>
                                        <td>
                                            <a href="{{url ('admin/offers/'.$offer->id.'/edit')}}" class="btn btn-primary"> Edit</a>
                                            <a href="{{url ('admin/offers/'.$offer->id.'/delete')}}" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger"> Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </div>
                        </table> 
        
                    </div>
                </div>


                    <!-- Delete Button Model  -->
                     
                <div wire:ignore.self class="modal fade" id="deleteModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title text-danger"><i class="mdi mdi-alert-octagon"></i> Alert !</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"> </button>
                        </div>

                            <div class="modal-body">
                                <h5>Are you sure, you want to Delete?</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <form method="get" action="{{url ('admin/offers/'.$offer->id.'/destroy')}}">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            </div>
                        
                        </div>
                    </div>
                    </div>
            </div>
    </div>

@endsection