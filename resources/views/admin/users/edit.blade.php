@extends('layouts.admin')
@section('title', 'Create User')
@section('content')

<div class="row">
            <div class="col-md-12 grid-margin">
                <div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="/admin/users"> <strong>Users</strong></a></li>
                        <li class="breadcrumb-item active"> Add User </li>
                    </ul>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between p-3">
                        <h2 class="fw-semibold text-secondary">Add User</h2>
                        <a href="{{url('admin/users')}}" class="btn btn-danger"> Back</a>
                    </div>
                    <div class="card-body">
                        <form action="{{url('admin/users/'.$user->id)}}" method="post">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="" >Name</label>
                                    <input name="name" type="text" class="form-control mt-2 @error('name') is-invalid @enderror" placeholder="Enter Name" value="{{old('name', $user->name)}}">
                                    @error('name')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">Email</label>
                                    <input name="email" id="" type="email" class="form-control mt-2 @error('email') is-invalid @enderror" placeholder="Enter Email" value="{{old('email', $user->email)}}" readonly>
                                    @error('email')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">Password</label>
                                    <input name="password" id="" type="password" class="form-control mt-2 @error('password') is-invalid @enderror" placeholder="Enter Password" value="{{old('password')}}">
                                    @error('password')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="">Select Role</label>
                                    <select name="role_as" class="form-control mt-2 @error('role_as') is-invalid @enderror">
                                        <option value=""> Select Role</option>
                                        <option value="0" {{old('role_as', $user->role_as == '0' ? 'selected' : '') }}> Customer</option>
                                        <option value="1" {{old('role_as', $user->role_as == '1'  ? 'selected' : '') }}> Admin</option>
                                    </select>
                                    @error('role_as')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            
                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-info float-end"> Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>

@endsection