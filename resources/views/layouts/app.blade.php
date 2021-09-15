<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  {!! SEOMeta::generate() !!}
  {!! OpenGraph::generate() !!}
  {!! Twitter::generate() !!}
  {!! JsonLd::generate() !!}
  <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
  <link rel="icon" href="/favicon.ico" type="image/x-icon">
  <title>{{ $config->title ?? "Chia sẻ và học hỏi" }}</title>
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  <link href="{{ mix('css/style.css') }}" rel="stylesheet">
  @livewireStyles
  @yield('styles')
  @stack('styles')
<!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-207659326-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-207659326-1');
  </script>

</head>

<body>
  <a id="to-top" href="#">
    <i class="bi bi-arrow-up" title="Back to top"></i>
  </a>
  <main class="container">
    @include('layouts.header')
    @include('layouts.nav')
    @yield('main')
  </main>
  @include('layouts.footer')
  @livewireScripts
  <script src="{{ mix('js/app.js') }}"></script>
  @yield('scripts')
  @stack('scripts')
</body>
</html>
