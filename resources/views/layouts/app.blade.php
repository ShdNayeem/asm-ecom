<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Styles -->

     <link rel="stylesheet" href="{{asset('build/assets/css/bootstrap.min.css')}}">
     <link rel="stylesheet" href="{{asset('build/assets/css/custom.css')}}">

     <!-- Owl Corousel -->
     <link rel="stylesheet" href="{{asset('build/assets/css/owl.carousel.min.css')}}">
     <link rel="stylesheet" href="{{asset('build/assets/css/owl.theme.default.min.css')}}">

     <!-- Ex Zoom -->
     <link rel="stylesheet" href="{{asset('build/assets/exzoom/jquery.exzoom.css')}}">

     <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/css/themes/default.min.css"/>

     @livewireStyles

</head>
<body>
    <div id="app">
        <!-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    ASM Ecom
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     Left Side Of Navbar
                    <ul class="navbar-nav me-auto">

                    </ul>

                    Right Side Of Navbar
                    <ul class="navbar-nav ms-auto">
                        <Authentication Links
                        
                    </ul>
                </div>
            </div>
        </nav> -->

        @include('layouts.inc.frontend.navbar')

        <main class="py-4">
            @yield('content')
        </main>

        @include('layouts.inc.frontend.footer')

    </div>

    <!-- Scripts -->
     <!-- <link rel="" href="{{asset('build/assets/js/bootstrap.bundle.min.js')}}"> -->
     <script src="{{asset('build/assets/js/bootstrap.bundle.min.js')}}"></script>

     <script src="{{asset('build/assets/js/jquery-3.7.1.min.js')}}"></script>

     <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>

     <script>
        window.addEventListener('message', event => {
            alertify.set('notifier','position', 'bottom-center');
            alertify.notify(event.detail.text, event.detail.type);
        })
     </script>

     <!-- Owl Corousel -->
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

     <script src="{{asset('build/assets/js/carousel.min.js')}}"></script>
     @yield('script')
     <!-- Font Awesome 6 CDN -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
     
     <!-- Ex Zoom -->
     <script src="{{asset('build/assets/exzoom/jquery.exzoom.js')}}"></script>

    <!-- autocomplete navbar search -->
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>

    <!-- Razorpay payment Checkout page -->
    <!-- <script src="https://checkout.razorpay.com/v1/checkout.js"></script> -->

    <script>
        $(document).ready(function() {

        src = "{{ route('searchproductsajax') }}";
        $( "#search_texts" ).autocomplete({
            source: function(request, response){
                $.ajax({
                        url: src,
                        data: {
                            term: request.term
                        },
                        dataType: "json",
                        success: function(data){
                            response(data)
                        }
                    });
                },
                minLength: 3,
            select: function(event, ui) {
            if (ui.item.url) {
                window.location.href = ui.item.url; // Redirect to product page
                }
            }
        });
    });
    </script>

    @livewireScripts
    @stack('scripts')

</body>
</html>