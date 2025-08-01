@extends('layouts.app')
@section('title', 'Thankyou for Shopping')
@section('content')

    <div class="py3 pyt-md-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    @if (session('message'))
                        <h5 class="alert alert-success">{{session('message')}}</h5>
                    @endif
                    <div class="p-4 shadow bg-white mb-1">
                        <h4>Thankyou for Shopping with ASM Ecom!</h4>
                    </div>
                    
                    <a href="{{url ('/') }}" class="btn btn-primary">Shop</a>
                </div>
            </div>
        </div>
    </div>


@endsection