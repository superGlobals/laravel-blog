<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta17
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title> @yield('pageTitle') </title>
    <!-- CSS files -->
    <base href="/">
    <link rel="shortcut icon" href="{{ \App\Models\Setting::find(1)->blog_favicon }}" type="image/x-icon">
    <link href="./back/dist/css/tabler.min.css?1674944402" rel="stylesheet"/>
    <link href="./back/dist/css/tabler-flags.min.css?1674944402" rel="stylesheet"/>
    <link href="./back/dist/css/tabler-payments.min.css?1674944402" rel="stylesheet"/>
    <link href="./back/dist/css/tabler-vendors.min.css?1674944402" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <link rel="stylesheet" href="{{ asset('back/dist/libs/ijabo.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back/dist/libs/ijaboCropTool/ijaboCropTool.min.css') }}">
    <link rel="stylesheet" href="{{ asset('jquery-ui-1.13.2/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('jquery-ui-1.13.2/jquery-ui.structure.min.css') }}">
    <link rel="stylesheet" href="{{ asset('jquery-ui-1.13.2/jquery-ui.theme.min.css') }}">

    @stack('stylesheets')
    @livewireStyles
    <link href="./back/dist/css/demo.min.css?1674944402" rel="stylesheet"/>
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body >
    <script src="./back/dist/js/demo-theme.min.js?1674944402"></script>
    <div class="page">
      <!-- Navbar -->
      @include('back.layouts.inc.header')
      <div class="page-wrapper">
        <!-- Page header -->
        @yield('pageHeader')
        <!-- Page body -->
        <div class="page-body">
          <div class="container-xl">
            @yield('content')
          </div>
        </div>
        @include('back.layouts.inc.footer')
      </div>
    </div>
    <!-- Libs JS -->
    <script src="{{ asset('back/dist/libs/jquery/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('back/dist/libs/ijabo/ijabo.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('back/dist/libs/ijaboCropTool/ijaboCropTool.min.js') }}"></script>
    <script src="{{ asset('back/dist/libs/ijaboViewer/jquery.ijaboViewer.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="./back/dist/libs/apexcharts/dist/apexcharts.min.js?1674944402" defer></script>
    <script src="./back/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1674944402" defer></script>
    <script src="./back/dist/libs/jsvectormap/dist/maps/world.js?1674944402" defer></script>
    <script src="./back/dist/libs/jsvectormap/dist/maps/world-merc.js?1674944402" defer></script>
    <script src="{{ asset('jquery-ui-1.13.2\jquery-ui.min.js') }}"></script>
    <!-- Tabler Core -->
    <script src="./back/dist/js/tabler.min.js?1674944402" defer></script>
   
    @stack('scripts')
    @livewireScripts
     {{-- Toastr Script --}}
     <script>
      $(document).ready(function() {
          toastr.options = {
              "progressBar": true,
              "positionClass": "toast-top-right"
          }  
      });

      window.addEventListener('success', event => {
          toastr.success(event.detail.message);
      });

      window.addEventListener('error', event => {
          toastr.error(event.detail.message);
      });
      
    </script>
    <script src="./back/dist/js/demo.min.js?1674944402" defer></script>
  </body>
</html>