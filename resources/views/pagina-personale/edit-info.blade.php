@extends('layouts.main')
@section('content')

    <!--====== pagina-personale css ======-->
    <link rel="stylesheet" href="{{ asset('css/pagina-personale.css') }}">

    <div class="container mx-auto">
        <!--- Copertina del profilo --->
        <div class="card copertina-profilo">
            @if(session()->has('error'))
                <div id="alert" class="flex p-4 mb-4 bg-red-100 border-t-4 border-red-500 dark:bg-red-200" role="alert">
                    <svg class="flex-shrink-0 w-5 h-5 text-red-700 dark:text-red-800" fill="currentColor"
                         viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                              clip-rule="evenodd"></path>
                    </svg>
                    <div class="ml-3 text-sm font-medium text-red-700 dark:text-red-800">
                        {{Session::get('error')}}
                    </div>
                    <button type="button" onclick="hideAlert()"
                            class="ml-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-red-200 dark:text-red-600 dark:hover:bg-red-300"
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
            @if ($errors->any())
                <div id="alert" class="flex p-4 mb-4 bg-red-100 border-t-4 border-red-500 dark:bg-red-200" role="alert">
                    @foreach ($errors->all() as $error)
                        <svg class="flex-shrink-0 w-5 h-5 text-red-700 dark:text-red-800" fill="currentColor"
                             viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        <div class="ml-3 text-sm font-medium text-red-700 dark:text-red-800">
                            Errore: {{$error}}
                        </div>
                    @endforeach
                    <button type="button" onclick="hideAlert()"
                            class="ml-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-red-200 dark:text-red-600 dark:hover:bg-red-300"
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
            </div>
        </div>
        <!--- Fine copertina del profilo --->

        <h2 class="testo titolo grande">Le tue informazioni</h2>
        <div class="card">
            <div class="card-body">
                <div class="form-container">
                    <form class="informazioni" method="POST"
                          action="{{ route('pagina-personale.update-info', $utente) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-6">
                            <div class="form-control float-left inline-block">
                                <label for="nome"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nome</label>
                                <input name="nome" type="text" id="nome" value="{{$utente->nome}}"
                                       class="@error('nome') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       required>
                            </div>
                            <div class="form-control float-right inline-block">
                                <label for="cognome"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cognome</label>
                                <input name="cognome" type="text" id="cognome" value="{{$utente->cognome}}"
                                       class="@error('cognome') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       required>
                            </div>
                        </div>
                        <div class="mb-6">
                            @if(Auth::user()->ruolo == 'ricercatore' || Auth::user()->ruolo == 'responsabile')
                                <div class="form-control float-left inline-block">
                                    <label for="email"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                                    <input name="email" type="email" id="email" value="{{$utente->email}}"
                                           class="@error('email') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           placeholder="name@flowbite.com" required>
                                </div>
                                <div class="form-control float-right inline-block">
                                    <label for="data_nascita"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Data
                                        di
                                        nascita</label>
                                    <input datepicker name="data_nascita" type="text" id="data_nascita"
                                           value="{{$utente->data_nascita.date('d/m/Y')}}"
                                           required
                                           class="@error('data_nascita') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                            @else
                                <div>
                                    <label for="email"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                                    <input name="email" type="email" id="email" value="{{$utente->email}}"
                                           class="@error('email') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           placeholder="name@flowbite.com" required>
                                </div>
                            @endif
                        </div>
                        <div class="mb-6">
                            <div class="form-control float-left inline-block">
                                <label for="password"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nuova
                                    password</label>
                                <input name="password" type="password" id="password" autocomplete="new-password"
                                       class="@error('password') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="form-control float-right inline-block">
                                <label for="password_confirmation"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Conferma
                                    password</label>
                                <input name="password_confirmation" type="password" id="password_confirmation"
                                       autocomplete="new-password"
                                       class="@error('password_confirmation') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                        </div>
                        @if(Auth::user()->ruolo == 'ricercatore' || Auth::user()->ruolo == 'responsabile')
                            <div class="mb-6">
                                <div class="form-control float-left inline-block">
                                    <label for="università"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Università</label>
                                    <input name="universita" type="text" id="università" value="{{$utente->universita}}"
                                           class="@error('universita') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                                <div class="form-control float-right inline-block">
                                    <label for="ambito_ricerca"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ambito
                                        di
                                        ricerca</label>
                                    <input name="ambito_ricerca" type="text" id="ambito_ricerca"
                                           value="{{$utente->ambito_ricerca}}"
                                           class="@error('ambito_ricerca') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                            </div>
                        @endif
                        @if(Auth::user()->ruolo == 'finanziatore')
                            <div class="mb-6">
                                <label for="nome_azienda"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Azienda</label>
                                <input name="nome_azienda" type="text" id="nome_azienda"
                                       value="{{$utente->nome_azienda}}"
                                       class="@error('nome_azienda') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                        @endif
                        <button type="submit"
                                class="text-white bg-gray-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Salva modifiche
                        </button>
                    </form>


                    <!-- MOBILE -->
                    <form class="informazioni hidden" method="POST"
                          action="{{ route('pagina-personale.update-info', $utente) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-6">
                            <label for="nome"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nome</label>
                            <input name="nome" type="text" id="nome" value="{{$utente->nome}}"
                                   class="@error('nome') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required>
                        </div>
                        <div class="mb-6">
                            <label for="cognome"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cognome</label>
                            <input name="cognome" type="text" id="cognome" value="{{$utente->cognome}}"
                                   class="@error('cognome') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   required>
                        </div>

                        @if(Auth::user()->ruolo == 'ricercatore' || Auth::user()->ruolo == 'responsabile')
                            <div class="mb-6">
                                <label for="email"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                                <input name="email" type="email" id="email" value="{{$utente->email}}"
                                       class="@error('email') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="name@flowbite.com" required>
                            </div>
                            <div class="mb-6">
                                <label for="data_nascita"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Data
                                    di
                                    nascita</label>
                                <input datepicker name="data_nascita" type="text" id="data_nascita"
                                       value="{{$utente->data_nascita.date('d/m/Y')}}"
                                       required
                                       class="@error('data_nascita') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                        @else
                            <div class="mb-6">
                                <label for="email"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                                <input name="email" type="email" id="email" value="{{$utente->email}}"
                                       class="@error('email') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       placeholder="name@flowbite.com" required>
                            </div>
                        @endif
                        <div class="mb-6">

                            <label for="password"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nuova
                                password</label>
                            <input name="password" type="password" id="password" autocomplete="new-password"
                                   class="@error('password') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        <div class="mb-6">
                            <label for="password_confirmation"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Conferma
                                password</label>
                            <input name="password_confirmation" type="password" id="password_confirmation"
                                   autocomplete="new-password"
                                   class="@error('password_confirmation') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                        @if(Auth::user()->ruolo == 'ricercatore' || Auth::user()->ruolo == 'responsabile')
                            <div class="mb-6">

                                <label for="università"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Università</label>
                                <input name="universita" type="text" id="università" value="{{$utente->universita}}"
                                       class="@error('universita') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                            <div class="mb-6">
                                <label for="ambito_ricerca"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ambito
                                    di
                                    ricerca</label>
                                <input name="ambito_ricerca" type="text" id="ambito_ricerca"
                                       value="{{$utente->ambito_ricerca}}"
                                       class="@error('ambito_ricerca') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>

                        @endif
                        @if(Auth::user()->ruolo == 'finanziatore')
                            <div class="mb-6">
                                <label for="nome_azienda"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Azienda</label>
                                <input name="nome_azienda" type="text" id="nome_azienda"
                                       value="{{$utente->nome_azienda}}"
                                       class="@error('nome_azienda') is-invalid @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                        @endif
                        <button type="submit"
                                class="text-white bg-gray-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Salva modifiche
                        </button>
                    </form>
                </div>
            </div>
        </div>
@endsection
