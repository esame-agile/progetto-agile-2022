@extends('layouts/main')
@section('content')

<!--====== HEADER PART START ======-->

<header class="header-area">
    <div id="home" class="relative z-10 header-hero">
        <div class="container">
            <div class="justify-center row">
                <div class="w-full lg:w-5/6 xl:w-2/3">
                    <div class="pt-48 pb-64 text-center header-content">
                        <h3 class="mb-5 text-3xl font-semibold leading-tight text-gray-900 md:text-5xl">Prendiamo le tue idee</h3>
                        <p class="px-5 mb-10 text-xl text-gray-700">e le diamo a chi le sa pensare e implementare</p>
                        <ul class="flex flex-wrap justify-center">
                            <li><a class="mx-3 main-btn gradient-btn" href="{{ route('ricercatori') }}">RICERCATORI</a></li>
                            <li><a class="mx-3 main-btn gradient-btn" >I NOSTRI PROGETTI </a></li>
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
                    <h4 class="title">Top 5 dei nostri ricercatori</h4>
                    <p class="text">Ecco alcuni volti di chi ha raggiunto i nostri maggior successi</p>
                </div> <!-- section title -->
            </div>
        </div> <!-- row -->

        <div class="row">
            <div class="w-full">
                <div class="row testimonial-active">
                    <div class="w-full lg:w-1/3">
                        <div class="text-center single-testimonial">
                            <div class="testimonial-image">
                                <img src={{ asset('images/francesca.jpg') }}  alt="Author">
                            </div>
                            <div class="testimonial-content">
                                <p class="pb-5 mb-6 border-b border-gray-300">“I migliori studi e le ricerche che si possono fare, sono quelli fatti per seguire le proprie passioni e soddisfare la propria curiosità. Non è indispensabile avere basi o conoscenze pregresse, la cosa più importante è avere passione e voglia di comprendere e imparare ciò che non conosciamo. La curiosità di cercare di capire è il vero motore della vita.”</p>
                                <h6 class="text-lg font-semibold text-gray-900">Francesca Moreira</h6>
                            </div>
                        </div> <!-- single testimonial -->
                    </div>
                    <div class="w-full lg:w-1/3">
                        <div class="text-center single-testimonial">
                            <div class="testimonial-image">
                                <img src={{ asset('images/jacob.jpg') }}  alt="Author">
                            </div>
                            <div class="testimonial-content">
                                <p class="pb-5 mb-6 border-b border-gray-300">“Non sono arrabbiato con Linux, davvero, e nemmeno lui ce l'ha con me.”</p>
                                <h6 class="text-lg font-semibold text-gray-900">Jacob Deidda</h6>

                            </div>
                        </div> <!-- single testimonial -->
                    </div>
                    <div class="w-full lg:w-1/3">
                        <div class="text-center single-testimonial">
                            <div class="testimonial-image">
                                <img src={{ asset('images/Roberto.jpg') }}  alt="Author">
                            </div>
                            <div class="testimonial-content">
                                <p class="pb-5 mb-6 border-b border-gray-300">“Vine sollecita il desiderio di essere registi e attori della propria vita; tenere il dito premuto sullo schermo, poi toglierlo, cambiareinquadratura e ripetere la stessa operazione più volte è un gesto essenziale che traduce un profondo mutamento di punto di vista. E cambiare punto di vista costringe a stimolare la creatività.”</p>
                                <h6 class="text-lg font-semibold text-gray-900">Roberto Paolini</h6>
                            </div>
                        </div> <!-- single testimonial -->
                    </div>
                    <div class="w-full lg:w-1/3">
                        <div class="text-center single-testimonial">
                            <div class="testimonial-image">
                                <img src={{ asset('images/cinese.jpg') }}  alt="Author">
                            </div>
                            <div class="testimonial-content">
                                <p class="pb-5 mb-6 border-b border-gray-300">“Il test di un programma può essere usato per mostrare la presenza di bug, ma mai per mostrare la loro assenza.”</p>
                                <h6 class="text-lg font-semibold text-gray-900">Mei Ling Huang</h6>
                            </div>
                        </div> <!-- single testimonial -->
                        <!-- single testimonial -->
                    </div>
                    <div class="w-full lg:w-1/3">
                        <div class="text-center single-testimonial">
                            <div class="testimonial-image">
                                <img src={{ asset('images/tedesca.jpg') }}  alt="Author">
                            </div>
                            <div class="testimonial-content">
                                <p class="pb-5 mb-6 border-b border-gray-300">"Considerando il cattivo stato dei nostri atttuali programmi per computer, lo sviluppo del software è chiaramente ancora una magia nera, e non può essere ancora definita una disciplina ingegneristica."</p>
                                <h6 class="text-lg font-semibold text-gray-900">Beatrix Weber</h6>
                            </div>
                        </div> <!-- single testimonial -->
                    </div>
                </div> <!-- row -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!--====== TESTIMONIAL THREE PART ENDS ======-->

<!--====== BACK TO TOP PART START ======-->

<a class="back-to-top" href="#"><i class="lni-chevron-up"></i></a>

<!--====== BACK TO TOP PART ENDS ======-->
@endsection
