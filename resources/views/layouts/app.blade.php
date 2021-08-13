<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <script src="{{ asset('js/app.js') }}" defer></script>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  @livewireStyles
</head>

<body>
  <div class="container">
    @include('layouts.header')
    @include('layouts.nav')
  </div>

  <main class="container">
    @yield('main')
  </main>

  @livewireScripts
  @include('layouts.footer')
</body>
</html>
