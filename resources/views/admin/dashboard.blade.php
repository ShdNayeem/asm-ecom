@extends('layouts.admin')
@section('title', 'Admin Dashboard')
@section('content')
        <div class="row">
          <div class="col-md-12 grid-margin">

              @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show shadow rounded-3 mb-2 w-75">
                  <h3><span class="me-2"><i class="bi bi-patch-check"></i></span> {{session('message')}}</h3>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif

              <div class="me-md-3 me-xl-5">
                    <h2 class="fw-semibold text-secondary"><i class="bi bi-person-workspace text-muted hover-cursor me-1"></i> Admin Dashboard </h2>
                    <hr>
              </div>

              <div class="row">
                <div class="col-md-3">
                  <div class="card card-body text-white mb-3 rounded dashboard-card bg-info">
                    <a href="{{ url('admin/orders') }}" class="text-white text-decoration-none d-block h-100">
                      <label class="text-uppercase fw-semibold mb-1 fs-6" style="opacity: 0.9;">Total Orders</label>
                      <h1 class="display-6 fw-bold">{{ $totalOrders }}</h1>
                      <span class="view-text">View</span>
                    </a>
                  </div>
                </div>


                  <div class="col-md-3">
                    <div class="card card-body text-white mb-3 bg-secondary dashboard-card rounded">
                      <a href="{{url ('admin/products') }}" class="text-white text-decoration-none d-block h-100">
                        <label class="text-uppercase fw-semibold mb-1 fs-6" style="opacity: 0.8;"> Total Products</label>
                        <h1 class="display-6 fw-bold">{{$totalProducts}}</h1>
                        <span class="view-text">View</span>
                      </a>
                    </div>
                  </div>
                
                <div class="col-md-3">
                  <div class="card card-body text-white mb-3 dashboard-card rounded" style="background-color:goldenrod;">
                    <a href="{{url ('admin/category') }}" class="text-white text-decoration-none">
                    <label class="text-uppercase fw-semibold mb-1 fs-6" style="opacity: 0.8;"> Total Categories</label>
                      <h1 class="display-6 fw-bold">{{$totalCategories}}</h1>
                      <span class="view-text">View</span>
                    </a>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="card card-body text-white mb-3 dashboard-card  rounded" style="background-color:darkgreen;">
                    <a href="{{url ('admin/offers') }}" class="text-white text-decoration-none">
                      <label class="text-uppercase fw-semibold mb-1 fs-6" style="opacity: 0.9;"> Total Offers</label>
                      <h1 class="display-6 fw-bold">{{$totalOffers}}</h1>
                      <span class="view-text">View</span>
                    </a>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="card card-body text-white mb-3 dashboard-card  rounded" style="background-color:brown;">
                    <a href="{{url ('admin/sliders') }}" class="text-white text-decoration-none">
                      <label class="text-uppercase fw-semibold mb-1 fs-6" style="opacity: 0.9;"> Total Sliders</label>
                      <h1 class="display-6 fw-bold">{{$totalSliders}}</h1>
                      <span class="view-text">View</span>
                    </a>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="card card-body text-white mb-3 dashboard-card  rounded" style="background-color:cadetblue;">
                    <a href="{{url ('admin/discounts') }}" class="text-white text-decoration-none">
                      <label class="text-uppercase fw-semibold mb-1 fs-6" style="opacity: 0.9;"> Total Discounts</label>
                      <h1 class="display-6 fw-bold">{{$totalDiscounts}}</h1>
                      <span class="view-text">View</span>
                    </a>
                  </div>
                </div>
              </div>
              <hr>

              <div class="row">
                  <div class="col-md-3">
                    <div class="card card-body text-white mb-3 dashboard-card  bg-primary rounded">
                      <a href="{{url ('admin/users') }}" class="text-white text-decoration-none">
                        <label class="text-uppercase fw-semibold mb-1 fs-6" style="opacity: 0.9;"> Total Users</label>
                        <h1 class="display-6 fw-bold">{{$totalAllUsers}}</h1>
                        <span class="view-text">View</span>
                      </a>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="card card-body text-white bg-success dashboard-card  mb-3 rounded">
                      <a href="{{url ('admin/users') }}" class="text-white text-decoration-none">
                        <label class="text-uppercase fw-semibold mb-1 fs-6" style="opacity: 0.8;">  Total Admins</label>
                        <h1 class="display-6 fw-bold">{{$totalAdmin}}</h1>
                        <span class="view-text">View</span>
                      </a>
                    </div>
                  </div>
                
                <div class="col-md-3">
                  <div class="card card-body text-white mb-3 bg-dark dashboard-card  rounded">
                    <a href="{{url ('admin/users') }}" class="text-white text-decoration-none">
                      <label class="text-uppercase fw-semibold mb-1 fs-6" style="opacity: 0.8;"> Total Customers</label>
                      <h1 class="display-6 fw-bold">{{$totalUser}}</h1>
                      <span class="view-text">View</span>
                    </a>
                  </div>
                </div>

              </div>
          </div>
        </div>
        
             <style>
                .dashboard-card {
                    position: relative;
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                    cursor: pointer;
                    overflow: hidden;
                    border: none;
                    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
                  }

                  .dashboard-card:hover {
                    transform: translateY(-8px) scale(1.02);
                    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
                  }

                  .dashboard-card .view-text {
                    display: inline-block;
                    margin-top: 10px;
                    font-size: 0.9rem;
                    position: relative;
                    transition: color 0.3s ease;
                  }

                  .dashboard-card .view-text::after {
                    content: ' →';
                    opacity: 0;
                    transform: translateX(-5px);
                    transition: all 0.3s ease;
                    display: inline-block;
                  }

                  .dashboard-card:hover .view-text::after {
                    opacity: 1;
                    transform: translateX(5px);
                  }
              </style>
@endsection