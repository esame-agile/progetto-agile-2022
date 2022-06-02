@include('/layouts/head')
@include('/layouts/footer')
@include('/layouts/navbar')
@include('/layouts/alert-message')

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@yield('head')
<body>
<div>
    @yield('navbar')
    <div class="min-h-screen">
        @yield('content')
    </div>
    @yield('footer')
</div>

</body>
<style>
    .min-h-screen {
        min-height: calc(100vh - 232px);
    }
</style>
</html>
