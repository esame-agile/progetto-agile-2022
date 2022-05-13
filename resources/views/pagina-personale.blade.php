@extends('layouts/main')
@section('content')

    <!--====== pagina-personale css ======-->
    <link rel="stylesheet" href="{{ asset('css/pagina-personale.css') }}">

    <div class="container mx-auto">
        <!--- Copertina del profilo --->
        <div class="card copertina-profilo">
            <div class="card-body">
                <div class="profile-background">
                    <!--- Immagine di copertina del profilo --->
                </div>
                <div class="profile-picture">
                    <!--- Immagine del profilo --->
                </div>

                <div class="nome-utente-container">
                    <p class="testo grande">{{$user->nome}} {{$user->cognome}} </p>
                    @auth
                        <a href="#"><i class="lni lni-pencil"></i></a>
                    @endauth
                    <p class="testo">{{$user->ambito_ricerca}}<br> {{$user->nome_azienda}}</p>
                </div>


                <div class="contatti">
                    <p class="testo">
                        {{$user->universita}}
                    </p>
                    <p class="testo">
                        {{$user->email}}
                    </p>
                </div>
            </div>
            <div class="contatti hidden">
                <p class="testo">
                    {{$user->universita}}
                </p>
                <p class="testo">
                    {{$user->email}}
                </p>
            </div>
        </div>
        <!--- Fine copertina del profilo --->

        <!--- Pubblicazioni --->
        <h2 class="testo titolo grande">Elenco pubblicazioni</h2>
        <div class="card tabella">
            <div class="container max-h-96">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Pubblicazione
                            </th>
                            <th scope="col" class="px-6 py-3 responsive">
                                Nome attributo
                            </th>
                            <th scope="col" class="px-6 py-3 responsive">
                                Nome attributo
                            </th>
                            <th scope="col" class="px-6 py-3 responsive">
                                Nome attributo
                            </th>
                            @auth()
                                <th scope="col" class="px-6 py-3 text-center">
                                    Edita
                                </th>
                            @endauth
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                Apple MacBook Pro 17"
                            </th>
                            <td class="px-6 py-4 text-left responsive">
                                Sliver
                            </td>
                            <td class="px-6 py-4 text-left responsive">
                                Laptop
                            </td>
                            <td class="px-6 py-4 text-left responsive">
                                $2999
                            </td>
                            @auth()
                                <td class="px-6 py-4 place-content-between">
                                    <a href="#"><i class="lni lni-pencil float-left"></i></a>
                                    <a href="#"><i class="lni lni-trash float-right"></i></a>
                                </td>
                            @endauth
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>  <!-- fine container -->
        </div>
        <!--- Fine pubblicazioni --->

        <!--- Ricerche --->
        <h2 class="testo titolo grande">Elenco progetti</h2>
        <div class="card tabella ">
            <div class="container">
                <div class="tabella-container relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Progetto
                            </th>
                            <th scope="col" class="px-6 py-3 responsive">
                                Nome attributo
                            </th>
                            <th scope="col" class="px-6 py-3 responsive">
                                Nome attributo
                            </th>
                            <th scope="col" class="px-6 py-3 responsive">
                                Nome attributo
                            </th>
                            @auth()
                                <th scope="col" class="px-6 py-3 text-center">
                                    Edita
                                </th>
                            @endauth
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                Apple MacBook Pro 17"
                            </th>
                            <td class="px-6 py-4 text-left responsive">
                                Sliver
                            </td>
                            <td class="px-6 py-4 text-left responsive">
                                Laptop
                            </td>
                            <td class="px-6 py-4 text-left responsive">
                                $2999
                            </td>
                            @auth()
                                <td class="px-6 py-4 place-content-between">
                                    <a href="#"><i class="lni lni-pencil float-left"></i></a>
                                    <a href="#"><i class="lni lni-trash float-right"></i></a>
                                </td>
                            @endauth
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--- Fine ricerche --->
    </div>

    <style>
        @media (max-width: 1024px) {
            .responsive {
                display: none;
            }


            .testo.grande, .testo.titolo.grande {
                font-size: 18px;
            }

            .testo {
                font-size: 14px;
            }
        }

        @media (max-width: 640px) {
            .contatti {
                display: none;
            }

            .contatti.hidden {
                display: inline-block;
                float: none;
                margin: 2% 0 5% 5%;
                text-align: left;
                position: relative;
            }
        }
    </style>
@endsection
