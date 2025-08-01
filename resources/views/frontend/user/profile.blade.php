@extends('layouts.app')
@section('title', 'User Profile')
@section('content')

<div class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h4>User Profile</h4>
                <div class="underline mb-4"></div>
            </div>

            <div class="col-md-10">
                @if (session('message'))
                    <div class="alert alert-success"> {{session('message')}}</div>
                @endif
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="card-header text-white py-3 px-4" style="background: linear-gradient(135deg, #3a658b, #4e91c1);">
                        <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"><i class="bi bi-person-circle me-2"></i> User Details</h4>
                        <a href="{{ url('/change-password') }}" class="btn fw-semibold" style="background: linear-gradient(135deg, #bbcaceff, #ade0ecff);">
                            <i class="bi bi-lock-fill me-1"></i> Change Password
                        </a>
                        </div>
                    </div>
                    
                    <div class="card-body p-4 bg-light">
                        <form action="{{ url('profile') }}" method="POST">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                            <label class="form-label fw-semibold"> User Name</label>
                            <input type="text" name="username" value="{{Auth()->user()->name}}" class="form-control @error('username') is-invalid @enderror" placeholder="Enter your name">
                            @error('username')
                                <div class="text-danger small mt-1"> {{ $message }}</div>
                            @enderror
                            </div>

                            <div class="col-md-6">
                            <label class="form-label fw-semibold"> Email Address</label>
                            <input type="email" readonly name="email" value="{{Auth()->user()->email}}" class="form-control" style="background-color: #f0f0f0;">
                            </div>

                            <div class="col-md-6">
                            <label class="form-label fw-semibold"> Phone Number</label>
                            <input type="text" name="phone" value="{{ Auth()->user()->userDetail->phone ?? '' }}" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter phone number">
                            @error('phone')
                                <div class="text-danger small mt-1"> {{ $message }}</div>
                            @enderror
                            </div>

                            <div class="col-md-6">
                            <label class="form-label fw-semibold"> Zip/Pin Code</label>
                            <input type="text" name="pin_code" value="{{Auth()->user()->userDetail->pin_code ?? '' }}" class="form-control @error('pin_code') is-invalid @enderror" placeholder="Enter zip code">
                            @error('pin_code')
                                <div class="text-danger small mt-1"> {{ $message }}</div>
                            @enderror
                            </div>

                            <div class="col-md-12">
                            <label class="form-label fw-semibold"> Address</label>
                            <input type="text" name="address" value="{{Auth()->user()->userDetail->address ?? '' }}" class="form-control @error('address') is-invalid @enderror" placeholder="Enter full address">
                            @error('address')
                                <div class="text-danger small mt-1"> {{ $message }}</div>
                            @enderror
                            </div>

                            <div class="col-12 text-end">
                            <button type="submit" class="btn px-4 py-2 fw-semibold rounded-3" style="background: linear-gradient(135deg, #3a658b, #4e91c1); color:white;">
                                <i class="bi bi-save2 me-1"></i> Save Data
                            </button>
                            </div>
                        </div>
                        </form>
                    </div>
                    </div>

            </div>
        </div>
    </div>
</div>
@endsection