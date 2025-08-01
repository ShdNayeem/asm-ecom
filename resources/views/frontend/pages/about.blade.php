@extends('layouts.app')
@section('title', 'About Us')
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

<section class="about-header">
  <div style="position: absolute; top: 0; bottom: 0; left: 0; right: 0; background-color: rgba(0, 0, 0, 0.5);"></div>
  <div class="container position-relative">
    <h1 class="display-4 fw-bold">About Us</h1>
    <p class="lead">{{$appSetting->page_title ?? ''}}</p>
  </div>
</section>

  <section class="py-5">
  <div class="container">
    <div class="row justify-content-center text-center">
      <div class="col-md-12">
        <h2 class="fw-bold text-primary mb-3">ASM Ecom Founded in 2010, our company has been committed to delivering excellence in every project we undertake. 
          Our journey began with a vision to simplify technology and improve lives through innovative solutions. 
          Today, we proudly serve thousands of customers around the globe.</h2>
        <h5 class="text-secondary">
          With a focus on quality, integrity, and customer satisfaction, we continue to grow and evolve with the changing landscape of business and technology. Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis provident neque facilis! Facilis amet repellat dolores! Ipsum quibusdam veniam velit?
        </h5>
      </div>
    </div>
  </div>
</section>

  <style>
  .custom-hr {
    width: 300px;
    height: 3px;
    background-color: #2874f0;
    margin-left: auto;
    margin-right: auto;
  }
</style>

  
<section class="py-5">
  <div class="container text-center">
    <h1 class="fw-bold mb-3">What’s Different When You Work With Us?</h1>
   <hr class="custom-hr mb-5">
    <div class="row">
      <div class="col-md-3 mb-4">
        <div class="card card-custom h-100">
          <img src="{{asset('aboutus/aboutus1.png')}}" class="card-img-top" alt="Personalized Approach">
          <div class="card-body">
            <h5 class="fw-semibold">Personalized Approach</h5>
            <p class="text-muted">
              We take time to understand your unique needs and tailor our services to match your goals and values.
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card card-custom h-100">
          <img src="{{asset('aboutus/aboutus2.png')}}" class="card-img-top" alt="Transparent Communication">
          <div class="card-body">
            <h5 class="fw-semibold">Transparent Communication</h5>
            <p class="text-muted">
              You'll always be informed. We maintain open, honest, and proactive communication throughout every project.
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card card-custom h-100">
          <img src="{{asset('aboutus/aboutus3.png')}}" class="card-img-top" alt="Long-Term Value">
          <div class="card-body">
            <h5 class="fw-semibold">Long-Term Value</h5>
            <p class="text-muted">
              We don’t just deliver — we ensure long-term results that continue to benefit your business beyond launch.
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="card card-custom h-100">
          <img src="{{asset('aboutus/aboutus4.png')}}" class="card-img-top" alt="Expert Support">
          <div class="card-body">
            <h5 class="fw-semibold">Expert Support</h5>
            <p class="text-muted">
              Our team of specialists is available to guide you every step of the way with real solutions and fast response.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection