@extends('layouts.admin')
@section('content')
    <div class="row">
            <div class="col-md-12 grid-margin">
                <div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="/admin/discounts"> <strong>Discounts</strong></a></li>
                        <li class="breadcrumb-item active"> Add Discount </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between p-3">
                        <h2 class="fw-semibold text-secondary">Add Discount</h2>
                        <a href="{{url('admin/discounts')}}" class="btn btn-danger"> Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{url('admin/discounts')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Discount Coupon</label>
                                    <input name="discount_name" type="text" class="form-control mt-2" placeholder="Discount Name" value="{{old('discount_name')}}">
                                    @error('discount_name')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label>Discount Value</label>
                                    <input name="discount_value" type="number" class="form-control mt-2" placeholder="Discount Value" value="{{old('discount_value')}}">
                                    @error('discount_value')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label>Valid From</label>
                                    <input name="valid_from"  type="date" class="form-control mt-2" placeholder="Discount Value" value="{{old('valid_from')}}">
                                    @error('valid_from')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label>Valid to</label>
                                    <input name="valid_to"  type="date" class="form-control mt-2" placeholder="Discount Value" value="{{old('valid_to')}}">
                                    @error('valid_to')
                                        <div class="text-danger">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label>Is Active</label>
                                    <div class="form-check form-switch ms-2">
                                        <input type="checkbox" name="is_active" class="form-check-input ms-2 mt-2" style="box-shadow: 0 0 8px rgba(40, 116, 240, 0.6); transform: scale(1.4);" id="isActiveSwitch">
                                        <label class="form-check-label" for="isActiveSwitch"> </label>
                                    </div>
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