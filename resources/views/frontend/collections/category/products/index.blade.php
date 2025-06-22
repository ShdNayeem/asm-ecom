@extends('layouts.app')
@section('title', 'Products')
@section('content')

<div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="{{url('/collections')}}">Category</a></li>
                            <li class="breadcrumb-item active"><a class="text-decoration-none text-secondary">Products</a></li>
                        </ul>
                    <h4 class="mb-4">Our Products</h4>
                </div>
                
                
                <livewire:frontend.product.index :products="$products" :category="$category"/>
                
            </div>
        </div>
    </div>

@endsection