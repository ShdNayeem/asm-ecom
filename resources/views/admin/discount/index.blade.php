@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12 grid-margin">
        @if (session('message'))
            <p class="alert alert-success w-75">{{ session('message') }}</p>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between p-3">
                <h2 class="fw-semibold text-secondary">Discounts</h2>
                <a href="{{ url('admin/discounts/create') }}" class="btn" style="background-color: green; color:white;">Add Discount</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Discount Coupon</th>
                                <th>Discount Value</th>
                                <th>Valid From</th>
                                <th>Valid To</th>
                                <th>Is Active</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($discounts as $discount)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $discount->discount_name }}</td>
                                    <td>{{ $discount->discount_value }}</td>
                                    <td>{{ $discount->valid_from }}</td>
                                    <td>{{ $discount->valid_to }}</td>
                                    <td>
                                        @if ($discount->is_active == '1')
                                            <span class="badge rounded" style="background-color: green; color:white;">Active</span>
                                        @else
                                            <span class="badge rounded bg-danger">Not Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/discounts/' . $discount->id . '/edit') }}" class="btn btn-info btn-sm">Edit</a>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $discount->id }}">Delete</button>
                                    </td>
                                </tr>

                                <!-- Delete Modal for this discount -->
                                <div class="modal fade" id="deleteModal{{ $discount->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $discount->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title text-danger"><i class="mdi mdi-alert-octagon"></i> Alert!</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Are you sure you want to delete <strong>{{ $discount->discount_name }}</strong>?</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <form method="get" action="{{ url('admin/discounts/' . $discount->id . '/delete') }}">
                                                    <button type="submit" class="btn btn-danger">Delete</button>
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
