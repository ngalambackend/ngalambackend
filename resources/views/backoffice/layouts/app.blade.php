@extends('backoffice.layouts.skeleton')

@section('app')
  <div class="main-wrapper">
    <div class="navbar-bg"></div>
    <nav class="navbar navbar-expand-lg main-navbar">
      @include('backoffice.partials.topnav')
    </nav>
    <div class="main-sidebar">
      @include('backoffice.partials.sidebar')
    </div>

    <!-- Main Content -->
    <div class="main-content">
      @yield('content')
    </div>
    <footer class="main-footer">
      @include('backoffice.partials.footer')
    </footer>
  </div>
@endsection
@section('javascript')
    @stack('js')
    @yield('js')
@endsection
