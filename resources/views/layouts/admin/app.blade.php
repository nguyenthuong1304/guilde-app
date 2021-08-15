<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Dashboard - SB Admin</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link href="{{ asset('admin/css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
  @yield('styles')
  @livewireStyles
</head>
<body class="sb-nav-fixed">
@include('layouts.admin.nav')
<div id="layoutSidenav">
  @include('layouts.admin.side_bar')
  <div id="layoutSidenav_content">
    <main>
      @yield('main')
    </main>
    @include('layouts.admin.footer')
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
@livewireScripts
@yield('scripts')
<script>
  toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  };

  window.livewire.on('alert', data => {
    const type = data[0];
    const message = data[1];
    toastr[type](message)
  });

  @if (session()->has('message'))
    let msg = JSON.parse('{{ json_encode(session('message')) }}'.replace(/&quot;/g,'"'));
    toastr[msg.type](msg.message)
  @endif
</script>
@stack('scripts')
</body>
</html>
