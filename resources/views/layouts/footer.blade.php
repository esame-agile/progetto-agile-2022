@section('footer')
    <footer id="footer" class="bg-gray-100 footer-area inset-x-0 bottom-0">
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="w-full">
                        <div class="items-end justify-between block mb-8 footer-logo-support md:flex">
                            <div class="flex items-end footer-logo">
                                <a class="mt-8" href="{{ route("home") }}"><img src={{ asset('images/Stark_Industrieslogo.png') }}  alt="Logo"></a>
                            </div> <!-- footer logo -->
                        </div>
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- footer copyright -->
    </footer>
@endsection
