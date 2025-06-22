@extends('layouts.admin')
@section('content')
    
<div class="row">
    <div class="col-md-12 grid-margin">
        @if (session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
        @endif
        <div class="card">
            <div class="card-header d-flex justify-content-between p-3">
                <a href="{{url('admin/products')}}" class="text-decoration-none text-dark"><h2>Products</h2></a>
                <a href="{{url('admin/products/create')}}" class="btn btn-primary"> Add Products </a>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                            <div class="thead">
                                <tr>
                                    <th>ID</th>
                                    <th>Category </th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Description</th>
                                    <th>Thumbnail</th>
                                    <th>Price</th>
                                    <th>Offer Price</th>
                                    <th>Actions</th>
                                </tr>
                            </div>

                            <div class="tbody">
                                @forelse ($products as $product)
                                    <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        @if ($product->category)
                                            {{$product->category->name}}
                                        @else
                                            No Category
                                        @endif  
                                    </td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->slug}}</td>
                                    <td>{{$product->description}}</td>
                                    <td>
                                        @if ($product->firstImage)
                                            <img src="{{ asset($product->firstImage->image) }}" width="60" height="60" alt="Product Image" style="border-radius: 0;">
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->offer_price}}</td>
                                    <td>
                                        <a href="{{url ('admin/products/'.$product->id.'/edit')}}" class="btn btn-primary"> Edit</a>
                                        <a href="{{url ('admin/products/'.$product->id.'/delete')}}" data-bs-toggle="modal" data-bs-target="#deleteProduct" class="btn btn-danger"> Delete</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7">No Products Available</td>
                                </tr>
                                @endforelse
                            </div>
                        </table> 
            </div>
        </div>
    </div>
</div>


<!-- Delete Product Modal -->

<div  wire:ignore.self class="modal fade" id="deleteProduct" tabindex="-1" aria-labelledby="deleteProduct" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header d-flex justify-content-center mt-1">
        <h1 class="modal-title fs-5 text-danger" id="deleteProduct" wire:click="closeModal"><i class="mdi mdi-alert-octagon"></i> Alert !</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{url ('admin/products/'.$product->id.'/delete')}}" method="get">
            <div class="modal-body">
                <h5> Are you sure, you want to Delete?</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="closeModal">Close</button>
                <button type="submit" class="btn btn-primary"> Delete </button>
            </div>
      </form>
      
    </div>
  </div>
</div>

@push('script')
    <script>
        window.addEventListener('close-modal', event =>{
            $('#deleteProduct').modal('hide');
        });
    </script>
@endpush

@endsection