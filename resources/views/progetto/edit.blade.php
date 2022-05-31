@extends('layouts/main')
@section('content')
    <div class="container mx-auto">
        @yield('alert-message')
        <h2 class="text-3xl font-bold leading-normal text-blueGray-700 mb-2 ml-5 uppercase">Aggiorna progetto</h2>
        <div class="card-grey mb-10">
            <form method="POST"
                  action="{{ route('progetto.update', $progetto) }}">
                @csrf
                @method('PUT')
                <div class="mb-6 flex flex-wrap justify-between">
                    <div class="w-1/3 pr-3">
                        <label for="titolo"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Titolo
                        </label>
                        <x-input name="titolo" type="text" id="titolo" value="{{ $progetto->titolo }}" required></x-input>
                    </div>
                    <div class="w-1/3">
                        <label for="scopo"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Scopo
                        </label>
                        <x-input name="scopo" type="text" id="scopo" value="{{ $progetto->scopo }}" required></x-input>
                    </div>
                    <div class="w-1/3 pl-3">
                        <label for="budget"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Budget
                        </label>
                        <x-input name="budget" type="number" id="budget" value="{{ $progetto->budget }}" required></x-input>
                    </div>
                </div>
                <div class="mb-6 flex flex-wrap justify-between">
                    <div class="w-full">
                        <label for="descrizione"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Descrizione
                        </label>
                        <x-input name="descrizione" type="text" id="descrizione" value="{{ $progetto->descrizione }}"
                                 required></x-input>
                    </div>
                </div>
                <div class="mb-6 flex flex-wrap justify-between">
                    <div class="w-1/3 pr-3">
                        <label for="data_inizio"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Data di inizio
                        </label>
                        <x-input name="data_inizio" type="date" id="data_inizio" value="{{ $progetto->data_inizio }}"
                                 required></x-input>
                    </div>
                    <div class="w-1/3">
                        <label for="data_fine"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Data di fine
                        </label>
                        <x-input name="data_fine" type="date" id="data_fine" value="{{ $progetto->data_fine }}"
                                 required></x-input>
                    </div>
                    <div class="w-1/3 pl-3">
                        <label for="responsabile_id"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Responsabile
                        </label>
                        <x-select name="responsabile_id">
                            @foreach($ricercatori as $ricercatore)
                                @if($progetto->responsabile_id == $ricercatore->id)
                                <option selected value="{{$ricercatore->id}}">{{$ricercatore->nome}} {{$ricercatore->cognome}}</option>
                                @else
                                <option
                                    value="{{$ricercatore->id}}">{{$ricercatore->nome}} {{$ricercatore->cognome}}</option>
                                @endif
                            @endforeach
                        </x-select>
                    </div>
                </div>

                <x-button type="submit">
                    Aggiorna progetto
                </x-button>
            </form>
        </div>
    </div>
@endsection
