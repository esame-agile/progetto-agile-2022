@section('navbar')
    <div class="navigation">
        <div class="container">
            <div class="row">
                <div class="w-full">
                    <nav class="flex items-center justify-between navbar navbar-expand-md">
                        <a class="mr-4 navbar-brand" href="{{route("home")}}">
                            <img src={{ asset('images/Stark_Industrieslogo.png') }}  alt="Logo">
                        </a>

                        <button class="block navbar-toggler focus:outline-none md:hidden" type="button"
                                data-toggle="collapse" data-target="#navbarOne" aria-controls="navbarOne"
                                aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>
                        <!-- justify-center hidden md:flex collapse navbar-collapse sub-menu-bar -->
                        <div
                            class="absolute left-0 z-30 hidden w-full px-5 py-3 duration-300 bg-white shadow md:opacity-100 md:w-auto collapse navbar-collapse md:block top-100 mt-full md:static md:bg-transparent md:shadow-none"
                            id="navbarOne">
                            <ul class="items-center content-start mr-auto lg:justify-center md:justify-end navbar-nav md:flex">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('ricercatore.index')}}">RICERCATORI</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('progetto.index')}}">PROGETTI</a>
                                </li>
                                @auth()
                                    @if(Auth::user()->ruolo == 'manager')
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('progetto.create')}}">CREA PROGETTO</a>
                                        </li>
                                    @endif
                                    @if(Auth::user()->ruolo == 'ricercatore')
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{route('ricercatore.progetti')}}">I MIEI
                                                PROGETTI</a>
                                        </li>
                                    @endif
                                    <li class="nav-item">
                                        <form method="POST" action="{{route('logout')}}" id="logout">
                                            @csrf
                                            <button class="nav-btn" type="submit">LOGOUT</button>
                                        </form>
                                    </li>
                                    <li class="">
                                        <a class="material-symbols-rounded nav-icon"
                                           href="{{route('home')}}">home</a>
                                    </li>
                                    <li class="">
                                        <a class="material-symbols-rounded nav-icon"
                                           href="{{route(Auth::user()->ruolo . '.show')}}">person</a>
                                    </li>
                                @endauth
                                @guest()
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('login')}}">LOGIN</a>
                                    </li>
                                    <li class="">
                                        <a class="material-symbols-rounded nav-icon"
                                           href="{{route('home')}}">home</a>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </nav> <!-- navbar -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- navgition -->

    <style>
        .nav-icon {
            padding: 0.75rem 1rem;
        }
    </style>
@endsection
