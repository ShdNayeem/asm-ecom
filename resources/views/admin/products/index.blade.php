@extends('layouts.admin')
@section('title', 'All Products')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        @if (session('message'))
            <div class="alert alert-success w-75">{{ session('message') }}</div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between p-3">
                <a href="{{ url('admin/products') }}" class="text-decoration-none text-dark">
                    <h2 class="fw-semibold text-secondary">Products</h2>
                </a>
                <a href="{{ url('admin/products/create') }}" class="btn text-white" style="background-color: green; color:white;">Add Product</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th class="fw-bold">ID</th>
                                <th class="fw-bold">Category</th>
                                <th class="fw-bold">Name</th>
                                <th class="fw-bold">Slug</th>
                                <th class="fw-bold">Description</th>
                                <th class="fw-bold">Thumbnail</th>
                                <th class="fw-bold">Price</th>
                                <th class="fw-bold">Offer Price</th>
                                <th class="fw-bold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->category->name ?? 'No Category' }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->slug }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>
                                        @if ($product->productImages->count() > 0)
                                            <img src="{{ asset($product->productImages->first()->image) }}" style="border-radius: 0;" width="60" height="60" alt="Product Image">
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ number_format($product->price, 2) }}</td>
                                    <td>{{ number_format($product->offer_price, 2) }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ url('admin/products/'.$product->id.'/edit') }}" class="btn btn-sm btn-info">Edit</a>
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteProductModal{{ $product->id }}">Delete</button>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Delete Modal Per Product -->
                                <div class="modal fade" id="deleteProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="deleteProductLabel{{ $product->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header d-flex justify-content-center mt-1">
                                                <h5 class="modal-title text-danger"><i class="mdi mdi-alert-octagon"></i> Confirm Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ url('admin/products/'.$product->id.'/delete') }}" method="get">
                                                <div class="modal-body">
                                                    <h5>Are you sure you want to delete <strong>{{ $product->name }}</strong>?</h5>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="9">No Products Available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $('#myTable').DataTable({
        pageLength: 5,
        lengthMenu: [5, 10, 25, 50, 100]
    });
</script>
@endpush
