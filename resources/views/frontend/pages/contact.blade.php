@extends('layouts.app')
@section('title', 'Contact Us')
@section('content')

<style>
    .about-header {
    background: url('{{ asset('aboutus/aboutushead.png')}}') center center / cover no-repeat;
    height: 400px;
    position: relative;
    color: white;
    display: flex;
    align-items: center;
    text-align: center;
  }
    
  </style>

  <!-- Header -->

  <section class="about-header">
  <div style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; background-color: rgba(0, 0, 0, 0.5);"></div>
  <div class="container position-relative">
    <h1 class="display-4 fw-bold">Contact Us</h1>
    <p class="lead">{{$appSetting->page_title ?? ''}}</p>
  </div>
</section>

  <section class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden" style="background: linear-gradient(135deg, #3a658b, #4e91c1);">
          <div class="p-5">
            <!-- Header -->
            <h3 class="fw-bold text-white mb-2">
             	<i class="fas fa-comments me-2"></i>Contact Information
            </h3>
            <p class="text-white-50 mb-4 ms-4">Reach out anytime for more details.</p>

          
            <div class="d-flex flex-column gap-3">

             
              <div class="d-flex bg-white rounded shadow-sm p-3 align-items-start">
                <i class="fas fa-building fs-4 text-dark me-3"></i>
                <div>
                  <h6 class="text-uppercase fw-bold text-dark mb-1">Address</h6>
                  <p class="mb-0">{{ $appSetting->address ?? '' }}</p>
                </div>
              </div>

           
              <div class="d-flex bg-white rounded shadow-sm p-3 align-items-start">
                <i class="fas fa-envelope fs-4 text-dark me-3"></i>
                <div>
                  <h6 class="text-uppercase fw-bold text-dark mb-1">Email</h6>
                  <p class="mb-0">{{ $appSetting->email1 ?? '' }}</p>
                  <p class="mb-0">{{ $appSetting->email2 ?? '' }}</p>
                </div>
              </div>

              
              <div class="d-flex bg-white rounded shadow-sm p-3 align-items-start">
                <i class="fas fa-phone fs-4 text-dark me-3"></i>
                <div>
                  <h6 class="text-uppercase fw-bold text-dark mb-1">Phone</h6>
                  <p class="mb-0">{{ $appSetting->phone1 ?? '' }}</p>
                  <p class="mb-0">{{ $appSetting->phone2 ?? '' }}</p>
                </div>
              </div>
            </div>
            
         
            <div class="pt-4 mt-4 border-top border-white-50">
              <h6 class="text-uppercase fw-bold text-white mb-3">Get Connected :</h6>
              <div class="d-flex gap-3">
                @if ($appSetting->instagram)
                  <a href="{{ $appSetting->instagram }}" target="_blank">
                      <i class="fab fa-instagram text-white fs-5"></i>
                  </a>
                @endif

                @if ($appSetting->facebook)
                    <a href="{{ $appSetting->facebook }}" target="_blank">
                        <i class="fab fa-facebook-f text-white fs-5"></i>
                    </a>
                @endif

                @if ($appSetting->twitter)
                    <a href="{{ $appSetting->twitter }}" target="_blank">
                        <i class="fab fa-x-twitter text-white fs-5"></i> <!-- X icon -->
                    </a>
                @endif

                @if ($appSetting->youtube)
                    <a href="{{ $appSetting->youtube }}" target="_blank">
                        <i class="fab fa-youtube text-white fs-5"></i>
                    </a>
                @endif

              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>



@endsection