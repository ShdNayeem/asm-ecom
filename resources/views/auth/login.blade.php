@extends('layouts.app')

@section('content')
<div class="container mt-3 mb-3">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-lg">
                <h3 class="card-header text-white py-3 text-center" style="background: linear-gradient(135deg, #3a658b, #4e91c1);">{{ __('Login') }}</h3>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control shadow-sm @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control shadow-sm @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 form-check d-flex justify-content-between">
                            <div class="mt-2">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                                </label>
                            </div>  
                            <div>
                                @if (Route::has('password.request'))
                                <a class="btn btn-link text-decoration-none" href="{{ route('password.request') }}">
                                    {{ __('Forgot Password') }}
                                </a>
                                @endif
                            </div>
                        </div>
                       
                        <div class="mb-3 d-grid gap-2">
                            <button type="submit" class="btn text-white py-2 fw-semibold" style="background: linear-gradient(135deg, #3a658b, #4e91c1);">
                                {{ __('Login') }}
                            </button>
                        </div>

                        <div class="text-center">
                            Doesn't have an Account? <a href="{{ route('register') }}" class="text-decoration-none"> Sign Up</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
