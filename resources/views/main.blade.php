<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <link href="https://cdn.jsdelivr.net/npm/@mdi/font@3.x/css/materialdesignicons.min.css" rel="stylesheet"> -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
      <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/typography.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">

    <link href='{{ asset("assets/fullcalendar/core/main.css") }}' rel='stylesheet' />
    <link href='{{ asset("assets/fullcalendar/daygrid/main.css") }}' rel='stylesheet' />
    <link href='{{ asset("assets/fullcalendar/timegrid/main.css") }}' rel='stylesheet' />
    <link href='{{ asset("assets/fullcalendar/list/main.css") }}' rel='stylesheet' />

      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style type="text/css">
        .iq-sidebar{
            z-index: 200!important
        }

       
    </style>
    

    <style type="text/css">
         @media (max-width: 650px) {
              .seacrPc{
                   display: none!important;
              }
         }

         @media (min-width: 283 ) {
              .titleCrud{
                   font-size: 15px!important;
              }
         }

         @media (min-width: 650px ) {
              .searchMovil{
                   visibility: hidden;
              }
         }
    </style>
    <title>Comercial</title>
</head>

<body> 

   
    <div id="app">
        <main-component></main-component>
    </div>
   <!--  <script type="text/javascript" src="{{ url('js/moment.min.js') }}"></script> -->
    <script type="text/javascript" src="{{ url('js/moment.min.js') }}"></script>

    <script src="{{ asset('assets/js/jquery.min.js') }} "></script>
    <script src="{{ asset('assets/js/popper.min.js') }} "></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }} "></script>
    <!-- Appear JavaScript -->
    <script src="{{ asset('assets/js/jquery.appear.js') }} "></script>
    <!-- Countdown JavaScript -->
    <script src="{{ asset('assets/js/countdown.min.js') }} "></script>
    <!-- Counterup JavaScript -->
    <script src="{{ asset('assets/js/waypoints.min.js') }} "></script>
    <script src="{{ asset('assets/js/jquery.counterup.min.js') }} "></script>
    <!-- Wow JavaScript -->
    <script src="{{ asset('assets/js/wow.min.js') }} "></script>
    <!-- Apexcharts JavaScript -->
    <script src="{{ asset('assets/js/apexcharts.js') }} "></script>
    <!-- Slick JavaScript -->
    <script src="{{ asset('assets/js/slick.min.js') }} "></script>
    <!-- Select2 JavaScript -->
    <script src="{{ asset('assets/js/select2.min.js') }} "></script>
    <!-- Owl Carousel JavaScript -->
    <script src="{{ asset('assets/js/owl.carousel.min.js') }} "></script>
    <!-- Magnific Popup JavaScript -->
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }} "></script>
    <!-- Smooth Scrollbar JavaScript -->
    <script src="{{ asset('assets/js/smooth-scrollbar.js') }} "></script>

    <script src="{{ asset('assets/js/lottie.js') }}"></script>
    <script src="{{ asset('assets/js/core.js') }}"></script>
    <script src="{{ asset('assets/js/charts.js') }}"></script>
    <script src="{{ asset('assets/js/animated.js') }}"></script>
    <script src="{{ asset('assets/js/kelly.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
     


    <!-- Chart Custom JavaScript -->
    <script src="{{ asset('assets/js/chart-custom.js') }} "></script>
    <!-- Custom JavaScript -->
    <script src="{{ asset('assets/js/custom.js') }} "></script>


    <script type="text/javascript" src="{{  url(mix('app/main.js')) }}"></script>
    <script type="text/javascript">
        
        
    </script>
</body>

</html>
