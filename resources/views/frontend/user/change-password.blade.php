@extends('layouts.app')
@section('title', 'Change Password')
@section('content')

<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                @if (session('message'))
                    <h5 class="alert alert-success mb-2">{{ session('message') }}</h5>
                @endif

                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="card-header text-white py-3 px-4" style="background: linear-gradient(135deg, #3a658b, #4e91c1);">
                        <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"> Change Password</h4>
                        <a href="{{ url('/profile') }}" class="btn fw-semibold" style="background: linear-gradient(135deg, #bbcaceff, #ade0ecff); color:secondary;">
                             Back
                        </a>
                        </div>
                    </div>

                    <div class="card-body p-4 bg-light">
                        <form action="{{ url('change-password') }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                        <div class="mb-4">
                            <label class="form-label fw-semibold"><i class="bi bi-key me-2 text-primary"></i>Current Password</label>
                            <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Enter current password">
                            @error('current_password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold"><i class="bi bi-lock me-2 text-primary"></i>New Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter new password">
                            @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold"><i class="bi bi-lock-fill me-2 text-primary"></i>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm new password">
                            @error('password_confirmation')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-end">
                            <hr>
                            <button type="submit" class="btn px-3 py-2 fw-semibold rounded-3"  style="background: linear-gradient(135deg, #3a658b, #4e91c1); color:white;">
                                 Update Password
                            </button>
                        </div>
                        </form>
                    </div>
                    </div>

            </div>
        </div>
    </div>
</div>

@endsection