@extends("layouts.main")
@section("content")
    <div class="container mx-auto">
        @yield('alert-message')
        <form class="informazioni" method="POST" id="informazioni"
              action="{{ route('sottoprogetti.store') }}">
            <h2 class="testo titolo grande">Nuovo Sottoprogetto</h2>
            <div class="card">
                <div class="card-body">
                    <div class="form-container">
                        @csrf
                        <div class="mb-6">
                            <div class="form-control float-left inline-block">
                                <label for="descrizione" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Titolo</label>
                                <x-input name="titolo" type="text" id="titolo" value="{{ old('titolo') }}"
                                         class="@error('titolo') is-invalid @enderror "
                                         required></x-input>
                            </div>
                            <div class="form-control float-right inline-block">
                                <label for="descrizione" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Descrizione</label>
                                <x-input name="descrizione" type="text" id="descrizione" value="{{ old('descrizione') }}"
                                         class="@error('descrizione') is-invalid @enderror "
                                         required></x-input>
                            </div>
                            <div class="form-control float-left inline-block">
                                <label for="data_rilascio"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Data Rilascio</label>
                                <x-input type="date" id="data_rilascio"
                                         name="data_rilascio"
                                         value="{{ old('data_rilascio') }}"
                                         required
                                         class="@error('data_rilascio') is-invalid @enderror">
                                </x-input>
                            </div>
                            <div class="form-control float-right inline-block">
                                <label for="responsabile_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Responsabile</label>
                                <x-select name="responsabile_id" id="responsabile_id" form="informazioni">
                                    <x-slot name="body">
                                        @foreach($responsabili as $responsabile)
                                            <option value="{{$responsabile->id}}">
                                                {{$responsabile->nome}} {{$responsabile->cognome}}
                                            </option>
                                        @endforeach
                                    </x-slot>
                                </x-select>
                            </div>
                            <div class="form-control float-right inline-block">
                                <label for="progetto_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Progetto</label>
                                <x-select name="progetto_id" id="progetto_id" form="informazioni">
                                    <x-slot name="body">
                                        @foreach($progetti as $progetto)
                                            <option value="{{$progetto->id}}">
                                                {{$progetto->titolo}}
                                            </option>
                                        @endforeach
                                    </x-slot>
                                </x-select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-button type="submit" >
                Crea Progetto
            </x-button>
        </form>
    </div>
@endsection
