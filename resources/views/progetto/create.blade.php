@extends('layouts/main')
@section('content')
    <div class="container mx-auto">
        @yield('alert-message')
        <h2 class="text-3xl font-bold leading-normal text-blueGray-700 mb-2 ml-5 uppercase">Crea progetto</h2>
        <div class="card-grey mb-10">
            <form method="POST"
                  action="{{ route('progetto.store') }}">
                @csrf
                <div class="mb-6 flex flex-wrap justify-between">
                    <div class="w-1/3 pr-3">
                        <label for="titolo"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Titolo
                        </label>
                        <x-input name="titolo" type="text" id="titolo" value="{{ old('titolo') }}" required></x-input>
                    </div>
                    <div class="w-1/3">
                        <label for="scopo"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Scopo
                        </label>
                        <x-input name="scopo" type="text" id="scopo" value="{{ old('scopo') }}" required></x-input>
                    </div>
                    <div class="w-1/3 pl-3">
                        <label for="budget"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Budget
                        </label>
                        <x-input name="budget" type="number" id="budget" value="{{ old('budget') }}" required></x-input>
                    </div>
                </div>
                <div class="mb-6 flex flex-wrap justify-between">
                    <div class="w-full">
                        <label for="descrizione"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Descrizione
                        </label>
                        <x-input name="descrizione" type="text" id="descrizione" value="{{ old('descrizione') }}"
                                 required></x-input>
                    </div>
                </div>
                <div class="mb-6 flex flex-wrap justify-between">
                    <div class="w-1/3 pr-3">
                        <label for="datainizio"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Data di inizio
                        </label>
                        <x-input name="datainizio" type="date" id="datainizio" value="{{ old('datainizio') }}"
                                 required></x-input>
                    </div>
                    <div class="w-1/3">
                        <label for="datafine"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Data di fine
                        </label>
                        <x-input name="datafine" type="date" id="datafine" value="{{ old('datafine') }}"
                                 required></x-input>
                    </div>
                    <div class="w-1/3 pl-3">
                        <label for="responsabile"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Responsabile
                        </label>
                        <select name="responsabile_id" name="responsabile"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected disabled value="">Incarica ricercatore...</option>
                            @foreach($ricercatori as $ricercatore)
                                <option
                                    value="{{$ricercatore->id}}">{{$ricercatore->nome}} {{$ricercatore->cognome}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <x-button type="submit">
                    Crea nuovo progetto
                </x-button>
            </form>
        </div>
    </div>



@endsection
