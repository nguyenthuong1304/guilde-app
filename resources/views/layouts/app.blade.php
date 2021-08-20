<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <title>Chia sẻ lập trình</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  @livewireStyles
  @yield('styles')
  @stack('styles`')
</head>

<body>
  <main class="container">
    @include('layouts.header')
    @include('layouts.nav')
    @yield('main')
  </main>
  @include('layouts.footer')
  @livewireScripts
  <script src="{{ asset('js/app.js') }}"></script>
  @yield('scripts')
  @stack('scripts')
</body>
</html>
