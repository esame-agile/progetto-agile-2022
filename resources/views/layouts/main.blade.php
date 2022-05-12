@include('/layouts/head')
@include('/layouts/footer')
@include('/layouts/navbar')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @yield('head')
    <body>
    @yield('navbar')
    @yield('content')
    </body>
    @yield('footer')
</html>
