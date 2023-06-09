
<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en-us">

<head>
	<meta charset="utf-8">
	<title>@yield('pageTitle')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
	@yield('meta_tags')
	{{-- <meta name="description" content="{{ blogInfo()->blog_description }}">
	<meta name="author" content="{{ blogInfo()->blog_name }}"> --}}
	<link rel="shortcut icon" href="{{ blogInfo()->blog_favicon }}" type="image/x-icon">
	<link rel="icon" href="{{ blogInfo()->blog_favicon }}" type="image/x-icon">
  
  <!-- theme meta -->
  <meta name="theme-name" content="reporter" />

	<!-- # Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Neuton:wght@700&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

	<!-- # CSS Plugins -->
	<link rel="stylesheet" href="{{ asset('front/plugins/bootstrap/bootstrap.min.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	@stack('stylesheets')

	<!-- # Main Style Sheet -->
	<link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
</head>

<body>

@include('front.layouts.inc.header')

<main>
    <section class="section">
        <div class="container">
            @yield('content')
        </div>
    </section>
</main>

@include('front.layouts.inc.footer')

<!-- # JS Plugins -->
<script src="{{ asset('front/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('front/plugins/bootstrap/bootstrap.min.js') }}"></script>
@stack('scripts')
<!-- Main Script -->
<script src="{{ asset('front/js/script.js') }}"></script>

</body>
</html>
