
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'User Dashboard') - Edvanta</title>

  <!-- Fonts and Icons -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet">
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

  <!-- Soft UI CSS -->
  <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.3') }}" rel="stylesheet">
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Custom Styles -->
  <style>
    body {
      font-family: "Open Sans", sans-serif;
    }
    .navbar .dropdown-menu {
      min-width: 180px;
    }
  </style>

  @stack('styles')
</head>

<body class="g-sidenav-show bg-gray-100">

  {{-- Navbar --}}

@include('layouts.partials.user-navbar')

  {{-- Main content --}}
  <main class="mt-4 px-4">
    @yield('content')
  </main>

  {{-- Success Alert --}}
  @if(session('success'))
    <div class="position-fixed bg-success text-white rounded px-4 py-2"
         style="top: 1rem; right: 1rem; z-index: 1050;">
      {{ session('success') }}
    </div>
  @endif

  {{-- Core JS --}}
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>

  @stack('scripts')
</body>

</html>
