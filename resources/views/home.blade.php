@extends('layouts/main')
@section('content')


<!--====== HEADER PART START ======-->
<div class="navigation">
    <div class="container">
        <div class="row">
            <div class="w-full">
                <nav class="flex items-center justify-between navbar navbar-expand-md">
                    <a class="mr-4 navbar-brand" >
                        <img src={{ asset('images/625px-Stark_Industries.png') }}  alt="Logo">

                    </a>

                    <button class="block navbar-toggler focus:outline-none md:hidden" type="button" data-toggle="collapse" data-target="#navbarOne" aria-controls="navbarOne" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="toggler-icon"></span>
                        <span class="toggler-icon"></span>
                        <span class="toggler-icon"></span>
                    </button>

                    <!-- justify-center hidden md:flex collapse navbar-collapse sub-menu-bar -->
                    <div class="absolute left-0 z-30 hidden w-full px-5 py-3 duration-300 bg-white shadow md:opacity-100 md:w-auto collapse navbar-collapse md:block top-100 mt-full md:static md:bg-transparent md:shadow-none" id="navbarOne">
                        <ul class="items-center content-start mr-auto lg:justify-center md:justify-end navbar-nav md:flex">
                            <!-- flex flex-row mx-auto my-0 navbar-nav -->

                            <li class="nav-item">
                                <a class="page-scroll" href="#service">Chi siamo</a>
                            </li>

                            <li class="nav-item">
                                <a class="page-scroll" href="#testimonial">Top 5</a>
                            </li>

                            <li class="nav-item"><a class="nav-link" href="{{route('dashboard')}}">Log in</a></li>

                        </ul>
                    </div>


                </nav> <!-- navbar -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</div> <!-- navgition -->

<header class="header-area">



    <div id="home" class="relative z-10 header-hero">
        <div class="container">
            <div class="justify-center row">
                <div class="w-full lg:w-5/6 xl:w-2/3">
                    <div class="pt-48 pb-64 text-center header-content">
                        <h3 class="mb-5 text-3xl font-semibold leading-tight text-gray-900 md:text-5xl">Prendiamo le tue idee</h3>
                        <p class="px-5 mb-10 text-xl text-gray-700">e le diamo a chi le sa pensare e implementare</p>
                        <ul class="flex flex-wrap justify-center">
                            <li><a class="mx-3 main-btn gradient-btn" href="javascript:void(0)">RICERCATORI</a></li>
                            <li><a class="mx-3 main-btn video-popup" href="https://www.youtube.com/watch?v=r44RKWyfcFw">I NOSTRI PROGETTI <i class="ml-2 lni-play"></i></a></li>
                        </ul>
                    </div> <!-- header content -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- header content -->
</header>

<!--====== HEADER PART ENDS ======-->

<!--====== SERVICES PART START ======-->

<section id="service" class="relative services-area py-120">
    <div class="container">
        <div class="flex">
            <div class="w-full mx-4 lg:w-1/2">
                <div class="pb-10 section-title">
                    <h4 class="title">Di cosa ci occupiamo</h4>
                    <p class="text">Aggiornamento continuo e assidua ricerca di soluzioni ottimali, il futuro è sempre più vicino </p>
                </div> <!-- section title -->
            </div>
        </div> <!-- row -->
        <div class="flex">
            <div class="w-full lg:w-2/3">
                <div class="row">
                    <div class="w-full md:w-1/2">
                        <div class="block mx-4 services-content sm:flex">
                            <div class="mb-8 ml-0 services-content media-body sm:ml-3">
                                <h4 class="services-title">Progetti nazionali ed Europei</h4>
                                <p class="text">Non ci facciamo fermare dai confini, la conoscenza è ovunque</p>
                            </div>
                        </div> <!-- services content -->
                    </div>
                    <div class="w-full md:w-1/2">
                        <div class="block mx-4 services-content sm:flex">
                            <div class="mb-8 ml-0 services-content media-body sm:ml-3">
                                <h4 class="services-title">Sempre a caccia di innovazione</h4>
                                <p class="text">Siamo sempre in continuo aggiornamento, non permettiamo a nessuno di lasciarci indietro.</p>
                            </div>
                        </div> <!-- services content -->
                    </div>
                    <div class="w-full md:w-1/2">
                        <div class="block mx-4 services-content sm:flex">
                            <div class="mb-8 ml-0 services-content media-body sm:ml-3">
                                <h4 class="services-title">Agenzia</h4>
                                <p class="text">Siamo un'azienda che non ha paura del nuovo, per lo sviluppo dei nostri software e per le nostre ricerche ci affidiamo ai metodi più rapidi, innovativi ed efficienti.</p>
                            </div>
                        </div> <!-- services content -->
                    </div>
                    <div class="w-full md:w-1/2">
                        <div class="block mx-4 services-content sm:flex">
                            <div class="mb-8 ml-0 services-content media-body sm:ml-3">
                                <h4 class="services-title">Trasparenza</h4>
                                <p class="text">Tutto il nostro lavoro è disponibile sul nostro portale.</p>
                            </div>
                        </div> <!-- services content -->
                    </div>
                </div> <!-- row -->
            </div> <!-- row -->
        </div> <!-- row -->
    </div> <!-- container -->
    <div class="services-image">
        <div class="image">

            <img src="{{ asset('/images/StarkIndustriesBack.jpg') }}" alt="Services">
        </div>
    </div> <!-- services image -->
</section>

<!--====== SERVICES PART ENDS ======-->



<!--====== TESTIMONIAL THREE PART START ======-->

<section id="testimonial" class="testimonial-area py-120">
    <div class="container">
        <div class="justify-center row">
            <div class="w-full mx-4 lg:w-1/2">
                <div class="pb-10 text-center section-title">
                    <h4 class="title">Testimonial</h4>
                    <p class="text">Stop wasting time and money designing and managing a website that doesn’t get results. Happiness guaranteed!</p>
                </div> <!-- section title -->
            </div>
        </div> <!-- row -->

        <div class="row">
            <div class="w-full">
                <div class="row testimonial-active">
                    <div class="w-full lg:w-1/3">
                        <div class="text-center single-testimonial">
                            <div class="testimonial-image">
                                <img src="assets/images/author-3.jpg" alt="Author">
                            </div>
                            <div class="testimonial-content">
                                <p class="pb-5 mb-6 border-b border-gray-300">Stop wasting time and money designing and managing a website that doesn’t get results. Happiness guaranteed! Stop wasting time and money designing and managing a website that doesn’t get results. Happiness guaranteed!</p>
                                <h6 class="text-lg font-semibold text-gray-900">Isabela Moreira</h6>
                                <span class="text-sm text-gray-700">CEO, GrayGrids</span>
                            </div>
                        </div> <!-- single testimonial -->
                    </div>
                    <div class="w-full lg:w-1/3">
                        <div class="text-center single-testimonial">
                            <div class="testimonial-image">
                                <img src="assets/images/author-1.jpg" alt="Author">
                            </div>
                            <div class="testimonial-content">
                                <p class="pb-5 mb-6 border-b border-gray-300">Stop wasting time and money designing and managing a website that doesn’t get results. Happiness guaranteed! Stop wasting time and money designing and managing a website that doesn’t get results. Happiness guaranteed!</p>
                                <h6 class="text-lg font-semibold text-gray-900">Fiona</h6>
                                <span class="text-sm text-gray-700">Lead Designer, UIdeck</span>
                            </div>
                        </div> <!-- single testimonial -->
                    </div>
                    <div class="w-full lg:w-1/3">
                        <div class="text-center single-testimonial">
                            <div class="testimonial-image">
                                <img src="assets/images/author-2.jpg" alt="Author">
                            </div>
                            <div class="testimonial-content">
                                <p class="pb-5 mb-6 border-b border-gray-300">Stop wasting time and money designing and managing a website that doesn’t get results. Happiness guaranteed! Stop wasting time and money designing and managing a website that doesn’t get results. Happiness guaranteed!</p>
                                <h6 class="text-lg font-semibold text-gray-900">Elon Musk</h6>
                                <span class="text-sm text-gray-700">CEO, SpaceX</span>
                            </div>
                        </div> <!-- single testimonial -->
                    </div>
                    <div class="w-full lg:w-1/3">
                        <div class="text-center single-testimonial">
                            <div class="testimonial-image">
                                <img src="assets/images/author-4.jpg" alt="Author">
                            </div>
                            <div class="testimonial-content">
                                <p class="pb-5 mb-6 border-b border-gray-300">Stop wasting time and money designing and managing a website that doesn’t get results. Happiness guaranteed! Stop wasting time and money designing and managing a website that doesn’t get results. Happiness guaranteed!</p>
                                <h6 class="text-lg font-semibold text-gray-900">Fajar Siddiq</h6>
                                <span class="text-sm text-gray-700">CEO, MakerFlix</span>
                            </div>
                        </div> <!-- single testimonial -->
                    </div>
                </div> <!-- row -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!--====== TESTIMONIAL THREE PART ENDS ======-->



<!--====== FOOTER PART START ======-->



<!--====== FOOTER PART ENDS ======-->

<!--====== BACK TO TOP PART START ======-->

<a class="back-to-top" href="#"><i class="lni-chevron-up"></i></a>

<!--====== BACK TO TOP PART ENDS ======-->




</body>

</html>
@endsection
