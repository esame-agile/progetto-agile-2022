@include('/layouts/head')
@include('/layouts/footer')
@include('/layouts/navbar')

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @yield('head')
    <body class="flex-wrapper">
    @yield('navbar')
    <div>
        @yield('content')
    </div>
    @yield('footer')
    </body>
</html>
