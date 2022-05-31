@extends("layouts.main")
@include("layouts.alert-message")
@section("content")
    <div class="container mx-auto">
        @yield('alert-message')
        <h2 class="text-3xl font-bold leading-normal text-blueGray-700 mb-2 ml-5 uppercase">Modifica sotto progetto</h2>
        <div class="card-grey mb-10">
            <form method="POST"
                  action="{{ route('sotto-progetto.update', $sottoProgetto) }}">
                @csrf
                @method('PUT')
                <div class="mb-6 flex flex-wrap justify-between">
                    <div class="w-1/2 pr-3">
                        <label for="titolo"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Titolo
                        </label>
                        <x-input name="titolo" type="text" id="titolo" value="{{$sottoProgetto->titolo}}"
                                 class="@error('descrizione') is-invalid @enderror" required>
                        </x-input>
                    </div>
                    <div class="w-1/2">
                        <label for="data_rilascio"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Data Rilascio
                        </label>
                        <x-input type="date" id="data_rilascio"
                                 name="data_rilascio"
                                 value="{{$sottoProgetto->data_rilascio }}"
                                 required
                                 class="@error('data_rilascio') is-invalid @enderror">
                        </x-input>
                    </div>
                </div>
                <div class="mb-6 flex flex-wrap justify-between">
                    <div class="w-1/2 pr-3">
                        <label for="descrizione"
                               class="block text-sm font-medium text-gray-900 dark:text-gray-300">
                            Descrizione
                        </label>
                        <x-input type="text" id="descrizione"
                                 name="descrizione"
                                 value="{{$sottoProgetto->descrizione }}"
                                 required
                                 class="@error('descrizione') is-invalid @enderror">
                        </x-input>
                    </div>
                    <div class="w-1/2">
                        <label for="responsabile_id"
                               class="block text-sm font-medium text-gray-900 dark:text-gray-300">Responsabile</label>
                        <x-select name="responsabile_id" id="responsabile_id">
                            @foreach($ricercatori as $ricercatore)
                                @if($sottoProgetto->responsabile_id == $ricercatore->id)
                                    <option selected
                                            value="{{$ricercatore->id}}">{{$ricercatore->nome}} {{$ricercatore->cognome}}</option>
                                @else
                                    <option
                                        value="{{$ricercatore->id}}">{{$ricercatore->nome}} {{$ricercatore->cognome}}</option>
                                @endif
                            @endforeach
                        </x-select>
                    </div>
                </div>
                <input type="hidden" name="progetto_id" id="progetto_id" value="{{$sottoProgetto->progetto_id}}">
                <x-button type="submit">
                    Salva modifiche
                </x-button>
            </form>
        </div>
    </div>
@endsection
