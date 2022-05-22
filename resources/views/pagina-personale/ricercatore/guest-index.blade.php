@extends('layouts.main')
@include('layouts.alert-message')
@section('content')

    <!--====== pagina-personale css ======-->
    <link rel="stylesheet" href="{{ asset('css/pagina-personale.css') }}">

    <div class="container mx-auto">
        <!--- Copertina del profilo --->
        <div class="card copertina-profilo">
            @yield('alert-message')
            <div class="card-body">
                <div class="profile-background">
                    <!--- Immagine di copertina del profilo --->
                </div>
                <div class="profile-picture">
                    <!--- Immagine del profilo --->
                </div>
                <div class="nome-utente-container">
                    <p class="testo grande">{{$utente->nome}} {{$utente->cognome}} </p>

                    <p class="testo">
                        {{$utente->ambito_ricerca}}
                        <br>
                        {{$utente->universita}}
                    </p>

                </div>
                <div class="contatti">
                    <p class="testo">
                        {{$utente->email}}
                    </p>
                </div>
            </div>
            <div class="contatti hidden">
                <p class="testo">
                    {{$utente->email}}
                </p>
            </div>
        </div>
        <!--- Fine copertina del profilo --->

        <h2 class="testo titolo grande">Elenco pubblicazioni</h2>
        <!--- Pubblicazioni --->
        <div class="card tabella">
            <section class="container mx-auto p-6 font-mono">
                <div class="w-full overflow-hidden rounded-lg shadow-lg">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full">
                            <thead>
                            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3">
                                    Pubblicazione
                                </th>
                                <th class="px-4 py-3 responsive">
                                    Nome attributo
                                </th>
                                <th class="px-4 py-3 responsive">
                                    Nome attributo
                                </th>
                                <th class="px-4 py-3 responsive">
                                    Nome attributo
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            <tr class="text-gray-700">
                                {{--@foreach($pubblicazioni as $pubblicazione)
                                    <th class="px-4 py-3">
                                        Pubblicazione {{$pubblicazione->titolo}}
                                    </th>
                                    <th class="px-4 py-3">
                                        Pubblicazione {{$pubblicazione->titolo}}
                                    </th>

                                @endforeach--}}
                                <td class="px-4 py-3 text-ms font-semibold border">
                                    Apple MacBook Pro 17"
                                </td>
                                <td class="px-4 py-3 text-ms font-semibold border responsive">
                                    Sliver
                                </td>
                                <td class="px-4 py-3 text-ms font-semibold border responsive">
                                    Laptop
                                </td>
                                <td class="px-4 py-3 text-ms font-semibold border responsive">
                                    $2999
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>  <!-- fine container -->
            </section>
        </div>
        <!--- Fine pubblicazioni --->

        <h2 class="testo titolo grande">Elenco progetti</h2>
        <!--- Progetti --->
        <div class="card tabella">
            <section class="container mx-auto p-6 font-mono">
                <div class="w-full overflow-hidden rounded-lg shadow-lg">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full">
                            <thead>
                            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3">
                                    Pubblicazione
                                </th>
                                <th class="px-4 py-3 responsive">
                                    Nome attributo
                                </th>
                                <th class="px-4 py-3 responsive">
                                    Nome attributo
                                </th>
                                <th class="px-4 py-3 responsive">
                                    Nome attributo
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            <tr class="text-gray-700">
                                {{--@foreach($progetti as $progetto)
                                    <th class="px-4 py-3">
                                        Pubblicazione {{$progetto->titolo}}
                                    </th>
                                    <th class="px-4 py-3">
                                        Pubblicazione {{$progetto->titolo}}
                                    </th>

                                @endforeach--}}
                                <td class="px-4 py-3 text-ms font-semibold border">
                                    Apple MacBook Pro 17"
                                </td>
                                <td class="px-4 py-3 text-ms font-semibold border responsive">
                                    Sliver
                                </td>
                                <td class="px-4 py-3 text-ms font-semibold border responsive">
                                    Laptop
                                </td>
                                <td class="px-4 py-3 text-ms font-semibold border responsive">
                                    $2999
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>  <!-- fine container -->
            </section>
        </div>
        <!--- Fine progetti --->
    </div>
@endsection
