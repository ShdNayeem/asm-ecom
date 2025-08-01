@extends('layouts.admin')

@section('title', 'All Users')

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin">
        @if (session('message'))
            <div class="alert alert-success w-75">{{ session('message') }}</div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between p-3">
                <a href="{{ url('admin/users') }}" class="text-decoration-none text-dark">
                    <h2 class="fw-semibold text-secondary">Users</h2>
                </a>
                <a href="{{ url('admin/users/create') }}" class="btn btn-success text-white">Add Users</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th class="fw-bold">ID</th>
                                <th class="fw-bold">Name</th>
                                <th class="fw-bold">Email</th>
                                <th class="fw-bold">Role</th>
                                <th class="fw-bold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->role_as == '1')
                                            <span class="badge bg-success rounded">Admin</span>
                                        @elseif ($user->role_as == '0')
                                            <span class="badge bg-secondary rounded">Customer</span>
                                        @else
                                            <span class="badge bg-danger rounded">None</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/users/'.$user->id.'/edit') }}" class="btn btn-info">Edit</a>
                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{ $user->id }}">
                                            Delete
                                        </button>
                                    </td>
                                </tr>

                                <!-- Delete Modal for Each User -->
                                <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteUserLabel{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header d-flex justify-content-center">
                                                <h5 class="modal-title text-danger"><i class="bi bi-exclamation-circle"></i> Confirm Delete</h5>
                                            </div>
                                            <div class="modal-body text-center">
                                                <p>Are you sure you want to delete user <strong>{{ $user->name }}</strong>?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <form method="GET" action="{{ url('admin/users/'.$user->id.'/delete') }}">
                                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="5">No Users Available</td>
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
