@extends('layouts.admin')
@section('title', 'Edit Profile')
@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
        @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show shadow rounded-3 mb-2">
                  <h3><span class="me-2"><i class="bi bi-patch-check"></i></span> {{session('message')}}</h3>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        @endif

            <form action="{{url ('/admin/settings') }}" method="post">
            @csrf
            
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between bg-info">
                    <h3 class="text-white mb-0 mt-2"> Profile</h3>
                    <a href="{{ url('admin/settings') }}" class="btn btn-danger">Back</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                        <label for="">Website Name</label>
                        <input type="text" name="website_name" class="form-control mb-1" value="{{$setting->website_name ?? ''}}">
                        <small class="text-warning">Tap to Edit</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Website URL</label>
                        <input type="text" name="website_url" class="form-control mb-1" value="{{$setting->website_url ?? ''}}">
                        <small class="text-warning">Tap to Edit</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Page Title</label>
                        <input type="text" name="page_title" class="form-control mb-1" value="{{$setting->page_title ?? ''}}">
                        <small class="text-warning">Tap to Edit</small>
                    </div>
                    </div>
                    
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-info py-3">
                    <h3 class="text-white mb-0"> Contact Details</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                        <label for="">Address</label>
                        <textarea type="text" name="address" class="form-control mb-1">{{$setting->address}}</textarea>
                        <small class="text-warning">Tap to Edit</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Phone No. 1</label>
                        <input type="text" name="phone1" class="form-control mb-1" value="{{$setting->phone1 ?? ''}}">
                        <small class="text-warning">Tap to Edit</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Phone No. 2</label>
                        <input type="text" name="phone2" class="form-control mb-1" value="{{$setting->phone2 ?? ''}}">
                        <small class="text-warning">Tap to Edit</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Email Id. 2</label>
                        <input type="text" name="email1" class="form-control mb-1" value="{{$setting->email1 ?? ''}}">
                        <small class="text-warning">Tap to Edit</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Email Id. 2</label>
                        <input type="text" name="email2" class="form-control mb-1" value="{{$setting->email2 ?? '' }}">
                        <small class="text-warning">Tap to Edit</small>
                    </div>
                    </div>
                    
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-info py-3">
                    <h3 class="text-white mb-0"> Social Media</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="">Facebook</label>
                            <input type="text" name="facebook" class="form-control mb-1" value="{{$setting->facebook ?? ''}}">
                            <small class="text-warning">Tap to Edit</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">X (Twitter)</label>
                            <input type="text" name="twitter" class="form-control mb-1" value="{{$setting->twitter ?? ''}}">
                            <small class="text-warning">Tap to Edit</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Instagram</label>
                            <input type="text" name="instagram" class="form-control mb-1" value="{{$setting->instagram ?? ''}}">
                            <small class="text-warning">Tap to Edit</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="">Youtube</label>
                            <input type="text" name="youtube" class="form-control mb-1" value="{{$setting->youtube ?? ''}}">
                            <small class="text-warning">Tap to Edit</small>
                        </div>
                    </div>
                    
                </div>
            </div>

            <div class="float-end">
                <button type="submit" class="btn btn-info text-white"> Save Profile</button>
            </div>
            
            </form>
        </div>
    </div>
@endsection