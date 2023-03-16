@extends('back.layouts.auth-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Login')

@section('content')
<div class="page page-center">
    <div class="container container-tight py-4">
      <div class="text-center mb-4">
        <a href="." class="navbar-brand navbar-brand-autodark"><img src="./back/static/logo.svg" height="36" alt=""></a>
      </div>
      @livewire('author-login-form')
      <div class="text-center text-muted mt-3">
        Don't have account yet? <a href="./back/sign-up.html" tabindex="-1">Sign up</a>
      </div>
    </div>
  </div>
    
@endsection