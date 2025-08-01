@extends('layouts.app')
@section('title', 'Payment')
@section('content')


<div>

    <h4 style="text-align: center">Processing your Payment...</h4>

    <form name="payment-form" action="{{ route('razorpay.success') }}" method="POST">
        @csrf
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
        <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
        <input type="hidden" name="razorpay_signature" id="razorpay_signature">
    </form>

    <!-- <div style="text-align: center; margin-top: 20px;">
        <button type="button" class="btn btn-success" id="rzp-button" onclick="startPayment()">Pay Now</button>
    </div> -->

    <div class="d-flex justify-content-center mt-5">
    <div class="card shadow border-0" style="max-width: 400px; width: 100%; padding: 30px;">
        <h5 class="text-center mb-4 text-secondary">Complete Your Payment</h5>

        <button type="button" class="btn payment-btn btn-success btn-lg w-75 ms-5 rounded-pill" id="rzp-button" onclick="startPayment()">
            <i class="fas fa-credit-card me-2"></i> Pay Now
        </button>
    </div>
</div>

    @endsection
    
       
    @push('scripts')
     <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
    document.getElementById('rzp-button').addEventListener('click', startPayment);
        function startPayment() {
            var options = {
                "key": "{{ $razorpayKey }}",
                "amount": "{{ $price * 100 }}",
                "currency": "INR",
                "name": "{{ $name }}",
                "description": "Test Transaction",
                "order_id": "{{ $orderId }}",
                "handler": function (response) {
                    // Fill hidden inputs
                    document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                    document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
                    document.getElementById('razorpay_signature').value = response.razorpay_signature;

                    // Submit the form
                    document.forms['payment-form'].submit();
                },
                "prefill": {
                    "name": "{{ $name }}",
                    "email": "{{ $email }}",
                    "contact": "{{ $phone }}"
                },
                "theme": {
                    "color": "#3399cc"
                }
            };

            var rzp = new Razorpay(options);
            rzp.open();
        }
    </script>
    @endpush
    


</div>


