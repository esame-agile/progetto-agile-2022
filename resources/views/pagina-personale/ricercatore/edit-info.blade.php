@extends('layouts.main')
@include('pagina-personale.alert-message')
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
            </div>
        </div>
        <!--- Fine copertina del profilo --->

        <h2 class="testo titolo grande">Le tue informazioni</h2>
        <div class="card">
            <div class="card-body">
                <div class="form-container">
                    <form class="informazioni" method="POST"
                          action="{{ route('pagina-personale.ricercatore.update-info', $utente) }}">
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
                            @if($utente->ruolo == 'ricercatore' || $utente->ruolo == 'responsabile')
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
                        @if($utente->ruolo == 'ricercatore' || $utente->ruolo == 'responsabile')
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
                        @if($utente->ruolo == 'finanziatore')
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
                          action="{{ route('pagina-personale.ricercatore.update-info', $utente) }}">
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

                        @if($utente->ruolo == 'ricercatore' || $utente->ruolo == 'responsabile')
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
                        @if($utente->ruolo == 'ricercatore' || $utente->ruolo == 'responsabile')
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
                        @if($utente->ruolo == 'finanziatore')
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
    </div>
@endsection
