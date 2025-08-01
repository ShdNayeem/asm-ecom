@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">

        @if (session('message'))
            <p class="alert alert-success w-75">{{ session('message') }}</p>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between p-3">
                <h2 class="fw-semibold text-secondary">Offer Texts</h2>
                <a href="{{ url('admin/offers/create') }}" class="btn text-white" style="background-color: green;">Add Offer</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th class="fw-bold">ID</th>
                                <th class="fw-bold">Product Name</th>
                                <th class="fw-bold">Description</th>
                                <th class="fw-bold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($offers as $offer)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $offer->product_name }}</td>
                                    <td>{{ $offer->description }}</td>
                                    <td>
                                        <a href="{{ url('admin/offers/'.$offer->id.'/edit') }}" class="btn btn-info">Edit</a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $offer->id }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>

                                <!-- Delete Modal for this offer -->
                                <div class="modal fade" id="deleteModal{{ $offer->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $offer->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-danger">Confirm Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete <strong>{{ $offer->product_name }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <form method="GET" action="{{ url('admin/offers/'.$offer->id.'/destroy') }}">
                                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
