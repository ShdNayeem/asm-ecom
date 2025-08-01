@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center text-white" style="background: linear-gradient(135deg, #3a658b, #4e91c1);"><h4>Welcome!</h4></div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="d-flex justify-content-center">
                        <div class="alert alert-success alert-dismissible fade show shadow rounded-3 px-4 py-3 col-md-8 text-center" role="alert">
                            <i class="bi bi-chat-text"></i> {{ session('status') }}
                        </div>
                    </div>
                    @endif
                    
                    <div class="text-center">{{ __('You are logged in!') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection