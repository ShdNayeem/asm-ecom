@extends('admin.dashboard')
@section('content')

    <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h2> Edit Category</h2>
                        <a href="{{ url('admin/category') }}" class="btn btn-primary"> Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('admin/category/'.$category->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="" >Name</label>
                                    <input name="name" type="text" class="form-control mt-2" value="{{$category->name}}">
                                    @error('name')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="">Slug</label>
                                    <input name="slug" type="text" class="form-control mt-2" value="{{$category->slug}}">
                                    @error('slug')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="">Description</label>
                                    <textarea name="description" id="" class="form-control mt-2" rows="3">{{$category->description}}</textarea>
                                    @error('description')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>


                                <div class="col-md-6 mb-3">
                                    <label for="">Thumbnail</label>
                                    <input name="image" type="file" class="form-control mt-2">
                                    <img src="{{ asset('/uploades/category/'.$category->image) }}" alt="category image" style="height: 50px; width: 50px; object-fit: contain;">
                                    @error('image')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                
                                <div class="col-md-12 mb-3 d-flex justify-content-end gap-3">
                                    <a href="{{ url('admin/category') }}" class="btn btn-secondary"> Cancel</a>
                                    <button type="submit" class="btn btn-primary"> Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
@endsection