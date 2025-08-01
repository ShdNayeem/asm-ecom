@extends('layouts.admin')
@section('title', 'Create Product')
@section('content')
    
<div class="row">
    <div class="col-md-12 grid-margin">

        <div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="/admin/products"> <strong>Products</strong></a></li>
                <li class="breadcrumb-item active"> Add Product </li>
            </ul>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between p-3">
                <h2 class="fw-semibold text-secondary"> Add Products</h2>
                <a href="{{url('admin/products')}}" class="btn btn-danger"> Back </a>
            </div>

            <div class="card-body">
                    <form action="{{url('admin/products')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="" class="mb-3">Category <span class="text-danger">*</span>
                                    </label>
                                    <select name="category_id" class="form-control" id="" value="{{old('category_id')}}">
                                        <option value="" disabled selected>Select an option</option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="" >Product Name  <span class="text-danger">*</span></label>
                                    <input name="name" type="text" class="form-control mt-2" placeholder="Enter Name" value="{{old('name')}}">
                                    @error('name')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="">Product Slug <span class="text-danger">*</span></label>
                                    <input name="slug" type="text" class="form-control mt-2" placeholder="Enter Slug" value="{{old('slug')}}">
                                    @error('slug')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="">Product Description <span class="text-danger">*</span></label>
                                    <textarea name="description" id="" class="form-control mt-2" rows="3" placeholder="Enter Description">{{old('description')}}</textarea>
                                    @error('description')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">Thumbnail <span class="text-danger">*</span></label>
                                    <input name="image[]" multiple type="file" class="form-control mt-2" value="{{old('image')}}">
                                    @error('image')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">Price <span class="text-danger">*</span></label>
                                    <input name="price" type="" class="form-control mt-2" placeholder="Enter Price" value="{{old('price')}}">
                                    @error('price')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for=""> Offer Price <span class="text-danger">*</span></label>
                                    <input name="offer_price" type="" class="form-control mt-2" placeholder="Enter Offer Price" value="{{old('offer_price')}}">
                                    @error('offer_price')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">MSME No. </label>
                                    <input name="msme_no" type="text" class="form-control mt-2" placeholder="Enter MSME NO" value="{{old('msme_no')}}">
                                    @error('msme_no')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">Net Weight  <span class="text-danger">*</span></label>
                                    <input name="net_weight" type="text" class="form-control mt-2" placeholder="Enter Net Weight" value="{{old('net_weight')}}">
                                    @error('net_weight')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for=""> Batch No. <span class="text-danger">*</span></label>
                                    <input name="batch_no" type="text" class="form-control mt-2" placeholder="Enter Batch No" value="{{old('batch_no')}}">
                                    @error('batch_no')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">MFG Date (Approx. when packed) <span class="text-danger">*</span></label>
                                    <input name="mfg_date" type="date" class="form-control mt-2" value="{{ old('mfgdate', date('Y-m-d')) }}">
                                    @error('mfg_date')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">MRP (Incl. all Tax) <span class="text-danger">*</span> </label>
                                    <select name="mrp"  class="form-control mt-2" id="" value="{{old('mrp')}}">
                                        <option value="" disabled selected>Select an option</option>
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                    @error('mrp')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">U.S.P </label>
                                    <input name="usp" type="text" class="form-control mt-2" placeholder="Enter U.S.P" value="{{old('usp')}}">
                                    @error('usp')
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