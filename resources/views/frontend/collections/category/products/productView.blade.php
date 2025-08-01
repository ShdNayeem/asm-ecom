@extends('layouts.app')
@section('title', 'Products')
@section('content')

     <ul class="breadcrumb col-md-6 ms-5 mt-2">
        <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="{{url('/')}}">Home</a></li>
        <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="{{url('/collections')}}">Category</a></li>
        <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="{{url('/collections/'.$category->slug)}}">{{$category->name}}</a></li>
        <li class="breadcrumb-item active">{{$product->name}}</li>
    </ul>

<livewire:frontend.product.view :category="$category" :product="$product"/>

@endsection