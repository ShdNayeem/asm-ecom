@extends('layouts.admin')
@section('content')
    <div class="row">
            <div class="col-md-12 grid-margin">
                <div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="/admin/offers"> <strong>Offers</strong></a></li>
                        <li class="breadcrumb-item active"> Add Offer </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between p-3">
                        <h2 class="fw-semibold text-secondary">Add Offer</h2>
                        <a href="{{url('admin/offers')}}" class="btn btn-danger"> Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{url('admin/offers')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="" >Product Name</label>
                                    <input name="product_name" type="text" class="form-control mt-2" placeholder="Enter Name">
                                    @error('product_name')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="">Offer Description</label>
                                    <textarea name="description" id="" class="form-control mt-2" rows="3" placeholder="Enter Description"></textarea>
                                    @error('description')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            
                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-info float-end"> Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection