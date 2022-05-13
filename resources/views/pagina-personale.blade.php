@extends('layouts/main')
@section('content')
    <!--====== pagina-personale css ======-->
    <link rel="stylesheet" href="{{ asset('css/pagina-personale.css') }}">

    <div class="container">
        <!--- Copertina del profilo --->
        <div class="card copertina-profilo">
            <div class="profile-background">
                <!--- Immagine di copertina del profilo --->
            </div>
            <div class="profile-picture">
                <!--- Immagine del profilo --->
            </div>
            <div class="nome-utente-container">
                <p class="testo grande">Nome Di Prova{{-- {{$nome}} {{$cognome}} --}} </p>
                @auth
                    <button class="edit-button"><i class="lni lni-pencil"></i></button>
                @endauth
                <p class="testo">Ambito di ricerca{{-- {{$ambito_ricerca}} --}} <br> {{-- {{$nome_azienda}} --}} romano
                    spa </p>

            </div>
            <div class="contatti">
                <p class="testo">
                    {{--{{$università}}--}}Università degli Studi di Milano
                </p>
                <p class="testo">
                    {{--{{$email}}--}}davide.deacetis13@gmail.com
                </p>
                <p class="testo">
                    {{--{{$telefono}}--}}3279461214
                </p>
            </div>
        </div>

        <!--- Fine copertina del profilo --->


        <!--- Pubblicazioni --->
        <h2 class="testo titolo grande">Elenco pubblicazioni</h2>
        <div class="card tabella">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Pubblicazione
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nome attributo
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nome attributo
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nome attributo
                        </th>
                        @auth()
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        @endauth
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            Apple MacBook Pro 17"
                        </th>
                        <td class="px-6 py-4 text-center">
                            Sliver
                        </td>
                        <td class="px-6 py-4 text-center">
                            Laptop
                        </td>
                        <td class="px-6 py-4 text-center">
                            $2999
                        </td>
                        @auth()
                            <td class="px-6 py-4 text-center">
                                <a href="#"
                                   class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            </td>
                        @endauth
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--- Fine pubblicazioni --->

        <!--- Ricerche --->
        <h2 class="testo titolo grande">Elenco progetti</h2>
        <div class="card tabella">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Progetto
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nome attributo
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nome attributo
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nome attributo
                        </th>
                        @auth()
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        @endauth
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="border-b dark:bg-gray-800 dark:border-gray-700 odd:bg-white even:bg-gray-50 odd:dark:bg-gray-800 even:dark:bg-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            Apple MacBook Pro 17"
                        </th>
                        <td class="px-6 py-4 text-center">
                            Sliver
                        </td>
                        <td class="px-6 py-4 text-center">
                            Laptop
                        </td>
                        <td class="px-6 py-4 text-center">
                            $2999
                        </td>
                        @auth()
                            <td class="px-6 py-4 text-center">
                                <a href="#"
                                   class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            </td>
                        @endauth
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--- Fine ricerche --->
    </div>
@endsection
