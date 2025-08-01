@extends('layouts.app')
@section('title', 'New Arrivals')
@section('content')

<div class="py-5 bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>New Arrivals</h4>
                <div class="underline mb-4"></div>
            </div>

            
                @forelse ($newArrivals as $newArrival)
                    <div class="col-md-3">
                        <div class="product-card shadow">
                            <span class="badge rounded bg-success ms-2 mt-2">New</span>
                                    <div class="product-card-img">
                                        <a href="{{url('/collections/'.$newArrival->category->slug.'/'.$newArrival->slug)}}">
                                            <img src="{{ asset($newArrival->productImages[0]->image) }}" alt="{{ $newArrival->name }}">
                                        </a>
                                        
                                    </div>
                                    <div class="product-card-body">
                                        <div class="mb-2">

                                            <span class="original-price">${{$newArrival->price}}</span>
                                            <span class="selling-price">${{$newArrival->offer_price}}</span>
                                        </div>
                                        <h5 class="product-name">
                                        <a href="{{url('/collections/'.$newArrival->category->slug.'/'.$newArrival->slug)}}">
                                                {{$newArrival->name}} 
                                        </a>
                                        </h5>
                                    </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12 p-2">
                        <h4>No Products Available</h4>
                    </div>
                @endforelse   
                    <div class="text-center">
                        <a href="{{url ('/collections')}}" class="btn btn-warning mt-2">View more</a>
                    </div>
                    
        </div>
    </div>
</div>

@endsection