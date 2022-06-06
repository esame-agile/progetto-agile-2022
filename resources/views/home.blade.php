@extends('layouts/main')
@section('content')

    <!--====== HEADER PART START ======-->

        <header class="header-area">
            <div id="home" class="relative z-10 header-hero" style="background-image:{{ asset('/images/StarkIndustriesBack.jpg') }}">
                <div class="container">
                    <div class="justify-center row">
                        <div class="w-full lg:w-5/6 xl:w-2/3">
                            <div class="pt-48 pb-72 text-center header-content">
                                <h3 class="mb-5 text-3xl font-semibold leading-tight text-gray-900 md:text-5xl">
                                    Prendiamo le tue idee <br> e le realizziamo</h3>

                                <ul class="flex flex-wrap justify-center">
                                    <li><a class="page-scroll mx-3 main-btn gradient-btn" href="#service">CHI SIAMO</a>
                                    </li>
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
                        <p class="text">Aggiornamento continuo e assidua ricerca di soluzioni ottimali, il futuro è
                            sempre più vicino </p>
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
                                    <p class="text">Siamo sempre in continuo aggiornamento, non permettiamo a nessuno di
                                        lasciarci indietro.</p>
                                </div>
                            </div> <!-- services content -->
                        </div>
                        <div class="w-full md:w-1/2">
                            <div class="block mx-4 services-content sm:flex">
                                <div class="mb-8 ml-0 services-content media-body sm:ml-3">
                                    <h4 class="services-title">Agenzia</h4>
                                    <p class="text">Siamo un'azienda che non ha paura del nuovo, per lo sviluppo dei
                                        nostri software e per le nostre ricerche ci affidiamo ai metodi più rapidi,
                                        innovativi ed efficienti.</p>
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


    <!--====== BACK TO TOP PART START ======-->

    <a class="back-to-top" href="#"><i class="lni-chevron-up"></i></a>

    <!--====== BACK TO TOP PART ENDS ======-->
@endsection
