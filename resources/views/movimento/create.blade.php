@extends('layouts/main')
@section('content')
    <div class="container mx-auto">
        @yield('alert-message')
        <h2 class="text-3xl font-bold leading-normal text-blueGray-700 mb-2 ml-5 uppercase">RICHIEDI SPESA</h2>
        <div class="card-grey mb-10">
            <form method="POST"
                  action="{{ route('movimento.store', compact('progetto')) }}">
                @csrf
                <div class="mb-6 flex flex-wrap justify-between">
                    <div class="w-1/3 pr-3">
                        <label for="causale"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Causale
                        </label>
                        <x-input name="causale" type="text" id="causale" value="{{ old('causale') }}"
                                 required></x-input>
                    </div>
                    <div class="w-1/3">
                        <label for="importo"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Importo
                        </label>
                        <x-input name="importo" type="number" id="importo" value="{{ old('importo') }}"
                                 min="0" required></x-input>
                    </div>
                    <div class="w-1/3 pl-3">
                        <label for="nome_progetto"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Progetto
                        </label>
                        <x-input name="nome_progetto" type="text" id="nome_progetto" value="{{ $progetto->titolo }}"
                                 disabled></x-input>
                    </div>
                </div>

                <x-button type="submit">
                    Crea nuovo spesa
                </x-button>
            </form>
        </div>
    </div>
@endsection
