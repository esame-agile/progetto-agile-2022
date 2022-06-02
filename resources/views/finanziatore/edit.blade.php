@extends('layouts.main')
@section('content')
    <div class="container mx-auto">
        <x-edit-profile>
            <!--- Copertina del profilo --->
            <x-slot name="profile_picture">
                <div class="profile-picture">
                    <!--- Immagine del profilo --->
                </div>
            </x-slot>
            <!--- Fine copertina del profilo --->

            <x-slot name="form">
                <form method="POST"
                      action="{{ route('finanziatore.update', $finanziatore) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-6 flex flex-wrap justify-between">
                        <div class="w-1/2 pr-3">
                            <label for="nome"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nome</label>
                            <x-input name="nome" type="text" id="nome" value="{{$finanziatore->nome}}"
                                     class="@error('nome') is-invalid @enderror "
                                     required></x-input>
                        </div>
                        <div class="w-1/2">
                            <label for="cognome"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cognome</label>
                            <x-input name="cognome" type="text" id="cognome" value="{{$finanziatore->cognome}}"
                                     class="@error('cognome') is-invalid @enderror "
                                     required></x-input>
                        </div>
                    </div>

                    <div class="mb-6 flex flex-wrap justify-between">
                        <div class="w-1/2 pr-3">
                            <label for="email"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                            <x-input name="email" type="email" id="email" value="{{$finanziatore->email}}"
                                     class="@error('email') is-invalid @enderror"
                                     placeholder="name@flowbite.com" required></x-input>
                        </div>
                        <div class="w-1/2">
                            <label for="azienda"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Azienda</label>
                            <x-input name="azienda" type="text" id="azienda" value="{{$finanziatore->nome_azienda}}"
                                     class="@error('nome_azienda') is-invalid @enderror"
                                     placeholder="name@flowbite.com" required></x-input>
                        </div>
                    </div>

                    <div class="mb-6 flex flex-wrap justify-between">
                        <div class="w-1/2 pr-3">
                            <label for="password"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nuova
                                password</label>
                            <x-input name="password" type="password" id="password" autocomplete="new-password"
                                     class="@error('password') is-invalid @enderror form-prova"></x-input>
                        </div>
                        <div class="w-1/2">
                            <label for="password_confirmation"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Conferma
                                password</label>
                            <x-input name="password_confirmation" type="password" id="password_confirmation"
                                     autocomplete="new-password"
                                     class="@error('password_confirmation') is-invalid @enderror "></x-input>
                        </div>
                    </div>
                    <button type="submit"
                            class="text-white bg-gray-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Salva modifiche
                    </button>
                </form>
            </x-slot>
        </x-edit-profile>
    </div>
@endsection
