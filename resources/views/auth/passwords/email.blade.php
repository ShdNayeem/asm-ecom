@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header text-white py-3 px-4" style="background: linear-gradient(135deg, #3a658b, #4e91c1);">
                        <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0"> Reset Password</h4>
                        <a href="{{ route('login') }}" class="btn fw-semibold" style="background: linear-gradient(135deg, #bbcaceff, #ade0ecff); color:secondary;">
                             Back
                        </a>
                        </div>
                    </div>
                
                <div class="card-body p-4">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="email" class="shadow-sm fw-semibold form-label">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                             @enderror
                        </div>

                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn text-white" style="background: linear-gradient(135deg, #3a658b, #4e91c1);">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
