@extends('layouts.app')
@section('title', 'Search Products')
@section('content')

<div class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h4>Search Results</h4>
                <div class="underline mb-4"></div>
            </div>

            
                @forelse ($searchProducts as $newArrival)
                <div class="col-md-10">
                    <div class="product-card">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="product-card-img">
                                    <a href="{{url('/collections/'.$newArrival->category->slug.'/'.$newArrival->slug)}}">
                                        <img src="{{ asset($newArrival->productImages[0]->image) }}" alt="{{ $newArrival->name }}">
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-9">
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
                                    <p style="height: 45px; overflow:hidden;">
                                        {{$newArrival->description}}
                                    </p>
                                    <a href="{{url('/collections/'.$newArrival->category->slug.'/'.$newArrival->slug)}}" class="btn btn-outline-primary">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @empty
                    <div class="col-md-12 p-2">
                        <h4>No Such Products Found</h4>
                    </div>
                @endforelse

                <div class="col-md-10">
                    {{$searchProducts->appends(request()->input())->links('pagination::bootstrap-5')}}
                </div>

        </div>
    </div>
</div>

@endsection