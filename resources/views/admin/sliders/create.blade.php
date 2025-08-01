@extends('layouts.admin')
@section('title', 'Add Slider')
@section('content')
    <div class="row">
            <div class="col-md-12 grid-margin">
                <div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="/admin/sliders"> <strong>Sliders</strong></a></li>
                        <li class="breadcrumb-item active"> Add Slider </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between p-3">
                        <h2 class="fw-semibold text-secondary">Add Slider</h2>
                        <a href="{{url('admin/sliders')}}" class="btn btn-danger"> Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{url('admin/sliders')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="" >Slider Title</label>
                                    <input name="title" type="text" class="form-control mt-2" placeholder="Enter Title" value="{{old('title')}}">
                                    @error('title')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="">Slider Description</label>
                                    <textarea name="description" id="" class="form-control mt-2" rows="3" placeholder="Enter Description">{{old('description')}}</textarea>
                                    @error('description')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="" >Slider Image</label>
                                    <input name="image" type="file" class="form-control mt-2">
                                    @error('image')
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