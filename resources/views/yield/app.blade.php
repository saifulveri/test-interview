<!DOCTYPE html>
<html lang="en">
    <head>
      @include('partial.head')
    </head>
    <body>
      @include('partial.header')
      @yield('content')
      @include('partial.footer')
      @stack('scripts')
    </body>
</html>
