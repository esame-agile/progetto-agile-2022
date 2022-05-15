@extends('layouts.main')
@section('content')

    <!--====== pagina-personale css ======-->
    <link rel="stylesheet" href="{{ asset('css/pagina-personale.css') }}">

    <div class="container mx-auto">
        <!--- Copertina del profilo --->
        <div class="card copertina-profilo">
            @if(session()->has('success'))
                <div id="alert" class="flex p-4 mb-4 bg-green-100 border-t-4 border-green-500 dark:bg-green-200"
                     role="alert">
                    <svg class="flex-shrink-0 w-5 h-5 text-red-700 dark:text-green-800" fill="currentColor"
                         viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <div class="ml-3 text-sm font-medium text-green-700 dark:text-green-800">
                        {{ session()->get('success') }}
                    </div>
                    <button type="button" onclick="hideAlert()"
                            class="ml-auto -mx-1.5 -my-1.5 bg-green-100 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-green-200 dark:text-green-600 dark:hover:bg-green-300"
                            data-dismiss-target="#alert" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            @endif
            <div class="card-body">
                <div class="profile-background">
                    <!--- Immagine di copertina del profilo --->
                </div>
                <div class="profile-picture">
                    <!--- Immagine del profilo --->
                </div>

                <div class="nome-utente-container">
                    <p class="testo grande">{{$utente->nome}} {{$utente->cognome}} </p>
                    @if(Auth::user()->ruolo == 'ricercatore' || Auth::user()->ruolo == 'responsabile')
                        {{-- Se l'utente è un ricercatore --}}
                        <p class="testo">
                            {{$utente->ambito_ricerca}}
                            <br>
                            {{$utente->universita}}
                        </p>
                    @endif
                </div>
                <div class="contatti">
                    @if(Auth::user()->ruolo == 'finanziatore')
                        {{-- Se l'utente è un ricercatore --}}
                        <p class="testo">
                            {{$utente->nome_azienda}}
                        </p>
                    @endif
                    <p class="testo">
                        {{$utente->email}}
                    </p>
                </div>
            </div>
                @auth
                    {{-- Pulsante per editare informazioni personali --}}
                    <a href="{{route('pagina-personale.edit-info', $utente)}}"><i class="lni lni-pencil edit"></i></a>
                @endauth
            <div class="contatti hidden">
                @if(Auth::user()->ruolo == 'finanziatore')
                    {{-- Se l'utente è un ricercatore --}}
                    <p class="testo">
                        {{$utente->nome_azienda}}
                    </p>
                @endif
                <p class="testo">
                    {{$utente->email}}
                </p>
            </div>
        </div>
        <!--- Fine copertina del profilo --->

        <!--- Pubblicazioni --->
        @if(Auth::user()->ruolo == 'finanziatore')
            <h2 class="testo titolo grande">Elenco publicazioni finanziati</h2>
        @else
            <h2 class="testo titolo grande">Elenco progetti</h2>
        @endif
        <div class="card tabella">
            <div class="container max-h-96">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                            @if(Auth::user()->ruolo == 'ricercatore' || Auth::user()->ruolo == 'responsabile' || Auth::user()->ruolo == 'manager')
                                <th scope="col" class="px-6 py-3 text-center">
                                    Edita
                                </th>
                            @endauth
                            @if(Auth::user()->ruolo == 'finanziatore')
                                <th scope="col" class="px-6 py-3 text-center">
                                    Azioni
                                </th>
                            @endif
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
                            @if(Auth::user()->ruolo == 'ricercatore' || Auth::user()->ruolo == 'responsabile' || Auth::user()->ruolo == 'manager')
                                <td class="px-6 py-4 place-content-between">
                                    <a href="#"><i class="lni lni-pencil float-left"></i></a>
                                    <a href="#"><i class="lni lni-trash float-right"></i></a>
                                </td>
                            @endauth
                            @if(Auth::user()->ruolo == 'finanziatore')
                                <td class="px-6 py-4 text-center">
                                    <a href="#"><i class="lni lni-dollar"></i></a>
                                </td>
                            @endif
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>  <!-- fine container -->
        </div>
        <!--- Fine pubblicazioni --->

        <!--- Progetti --->
        @if(Auth::user()->ruolo == 'finanziatore')
            <h2 class="testo titolo grande">Elenco progetti finanziati</h2>
        @else
            <h2 class="testo titolo grande">Elenco progetti</h2>
        @endif
        <div class="card tabella ">
            <div class="container">
                <div class="tabella-container relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                            @if(Auth::user()->ruolo == 'ricercatore' || Auth::user()->ruolo == 'responsabile' || Auth::user()->ruolo == 'manager')
                                <th scope="col" class="px-6 py-3 text-center">
                                    Edita
                                </th>
                            @endif
                            @if(Auth::user()->ruolo == 'finanziatore')
                                <th scope="col" class="px-6 py-3 text-center">
                                    Azioni
                                </th>
                            @endif
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
                            @if(Auth::user()->ruolo == 'ricercatore' || Auth::user()->ruolo == 'responsabile' || Auth::user()->ruolo == 'manager')
                                <td class="px-6 py-4 place-content-between">
                                    <a href="#"><i class="lni lni-pencil float-left"></i></a>
                                    <a href="#"><i class="lni lni-trash float-right"></i></a>
                                </td>
                            @endif
                            @if(Auth::user()->ruolo == 'finanziatore')
                                <td class="px-6 py-4 text-center">
                                    <a href="#"><i class="lni lni-dollar"></i></a>
                                </td>
                            @endif
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--- Fine ricerche --->
    </div>
@endsection
