@extends('admin.dashboard')
@section('content')
    <div class="row">
            <div class="col-md-12 grid-margin">
                <div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="/admin/category"> <strong>Category</strong></a></li>
                        <li class="breadcrumb-item active"> Add Category </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between p-3">
                        <a href="/admin/category" class="text-decoration-none text-dark"> <h2>Add Category</h2> </a>
                        <a href="{{url('admin/category')}}" class="btn btn-primary"> Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{url('admin/category')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="" >Category Name</label>
                                    <input name="name" type="text" class="form-control mt-2" placeholder="Enter Name">
                                    @error('name')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="">Category Slug</label>
                                    <input name="slug" type="text" class="form-control mt-2" placeholder="Enter Slug">
                                    @error('slug')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="">Category Description</label>
                                    <textarea name="description" id="" class="form-control mt-2" rows="3" placeholder="Enter Description"></textarea>
                                    @error('description')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">Thumbnail</label>
                                    <input name="image" type="file" class="form-control mt-2">
                                    @error('image')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            
                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-primary float-end"> Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection