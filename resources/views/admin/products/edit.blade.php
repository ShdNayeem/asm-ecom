@extends('layouts.admin')
@section('title', 'Edit Product')
@section('content')
    
<div class="row">
    <div class="col-md-12 grid-margin">

        <div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="/admin/products"> <strong>Products</strong></a></li>
                <li class="breadcrumb-item active"> Add Product </li>
            </ul>
        </div>

        @if (session('message'))
            <div class="alert alert-success"> {{session('message')}}</div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between p-3">
                <h2 class="fw-semibold text-secondary"> Add Products</h2>
                <a href="{{url('admin/products')}}" class="btn btn-danger"> Back </a>
            </div>

            <div class="card-body">
                    <form action="{{url('admin/products/'.$product->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="" class="mb-3">Category</label>
                                    <select name="category_id" class="form-control" id="">
                                        <option value="" disabled selected>Select an option</option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected' : ''}}>
                                                {{$category->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="" >Product Name</label>
                                    <input name="name" type="text" class="form-control mt-2" placeholder="Enter Name" value="{{$product->name, old('name')}}">
                                    @error('name')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="">Product Slug</label>
                                    <input name="slug" type="text" class="form-control mt-2" placeholder="Enter Slug" value="{{$product->slug, old('slug')}}">
                                    @error('slug')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="">Product Description</label>
                                    <textarea name="description" id="" class="form-control mt-2" rows="3" placeholder="Enter Description">{{$product->description, old('description')}}</textarea>
                                    @error('description')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">Thumbnail</label>
                                    <input name="image[]" multiple type="file" class="form-control mt-2" value="{{old('image')}}">
                                    @error('image')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror

                                    @if ($product->productImages)
                                        <div class="mt-2 d-flex flex-wrap gap-2">
                                            @foreach ($product->productImages as $image)
                                                <div>
                                                    <img src="{{ asset($image->image) }}" class="p-1 border border-2 mb-2" alt="Product Image" width="100" height="100"><br>
                                                    <a href="{{ url('admin/product-image/'.$image->id.'/delete') }}" class="d-block">Remove</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <h5 class="mt-2 text-danger">No Image</h5>
                                    @endif
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">Price</label>
                                    <input name="price" type="" class="form-control mt-2" placeholder="Enter Price" value="{{ old('price', number_format($product->price, 2, '.', '')) }}">
                                    @error('price')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for=""> Offer Price</label>
                                    <input name="offer_price" type="" class="form-control mt-2" placeholder="Enter Offer Price" value="{{ old('offer_price', number_format($product->offer_price, 2, '.', '')) }}">
                                    @error('offer_price')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">MSME No. </label>
                                    <input name="msme_no" type="text" class="form-control mt-2" placeholder="Enter MSME NO" value="{{$product->msme_no, old('msme_no')}}">
                                    @error('msme_no')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">Net Weight </label>
                                    <input name="net_weight" type="text" class="form-control mt-2" placeholder="Enter Net Weight" value="{{$product->net_weight, old('net_weight')}}">
                                    @error('net_weight')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for=""> Batch No.</label>
                                    <input name="batch_no" type="text" class="form-control mt-2" placeholder="Enter Batch No" value="{{$product->batch_no, old('batch_no')}}">
                                    @error('batch_no')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">MFG Date (Approx. when packed) </label>
                                    <input name="mfg_date" type="date" class="form-control mt-2" value="{{ old('mfgdate', date('Y-m-d')) }}">
                                    @error('mfg_date')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">MRP (Incl. all Tax)</label>
                                    <select name="mrp" class="form-control mt-2">
                                        <option value="" disabled {{ old('mrp', $product->mrp ?? '') === null ? 'selected' : '' }}>Select an option</option>
                                        <option value="1" {{ old('mrp', $product->mrp ?? '') == '1' ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ old('mrp', $product->mrp ?? '') == '0' ? 'selected' : '' }}>No</option>
                                    </select>
                                    @error('mrp')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>


                                <div class="col-md-6 mb-3">
                                    <label for="">U.S.P </label>
                                    <input name="usp" type="text" class="form-control mt-2" placeholder="Enter U.S.P" value="{{$product->usp, old('usp')}}">
                                    @error('usp')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            
                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-info float-end"> Update</button>
                                </div>
                            </div>
                    </form>                
            </div>
        </div>
    </div>
</div>

@endsection