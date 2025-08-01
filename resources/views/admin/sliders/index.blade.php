@extends('layouts.admin')
@section('title', 'All Sliders')
@section('content')

<div class="row">
    <div class="col-md-12 grid-margin">
        @if (session('message'))
            <p class="alert alert-success w-75">{{ session('message') }}</p>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between p-3">
                <h2 class="fw-semibold text-secondary">Sliders</h2>
                <a href="{{ url('admin/sliders/create') }}" class="btn" style="background-color: green; color:white;">Add Slider</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table id="myTable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="fw-bold">ID</th>
                                <th class="fw-bold">Slider Title</th>
                                <th class="fw-bold">Description</th>
                                <th class="fw-bold">Image</th>
                                <th class="fw-bold">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($sliders as $slider)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->description }}</td>
                                    <td>
                                        <img src="{{ asset($slider->image) }}" style="width: 100px; height: 70px; border-radius:0;" alt="Slider Image">
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/sliders/' . $slider->id . '/edit') }}" class="btn btn-info btn-sm">Edit</a>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteSliderModal{{ $slider->id }}">
                                            Delete
                                        </button>
                                    </td>
                                </tr>

                                <!-- Individual Delete Modal -->
                                <div class="modal fade" id="deleteSliderModal{{ $slider->id }}" tabindex="-1" aria-labelledby="deleteSliderModalLabel{{ $slider->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title text-danger"><i class="mdi mdi-alert-octagon"></i> Alert!</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Are you sure you want to delete <strong>{{ $slider->title }}</strong>?</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <a href="{{ url('admin/sliders/'.$slider->id.'/destroy') }}" class="btn btn-danger">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="5">No Sliders Available</td>
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
