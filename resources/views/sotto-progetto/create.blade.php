@extends("layouts.main")
@section("content")
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold leading-normal text-blueGray-700 mb-2 ml-5 uppercase">Crea sotto progetto</h2>
        @yield('alert-message')
        <div class="card-grey mb-10">
            <form method="POST"
                  action="{{ route('sotto-progetto.store') }}">
                @csrf
                <div class="mb-6 flex flex-wrap justify-between">
                    <div class="w-1/3 pr-3">
                        <label for="titolo"
                               class="block text-sm font-medium text-gray-900 dark:text-gray-300">
                            Titolo
                        </label>
                        <x-input name="titolo" type="text" id="titolo" value="{{ old('titolo') }}" required></x-input>
                    </div>
                    <div class="w-1/3">
                        <label for="descrizione"
                               class="block text-sm font-medium text-gray-900 dark:text-gray-300">
                            Descrizione
                        </label>
                        <x-input name="descrizione" type="text" id="descrizione" value="{{ old('descrizione') }}"
                                 required></x-input>
                    </div>
                    <div class="w-1/3 pl-3">
                        <label for="data_rilascio"
                               class="block text-sm font-medium text-gray-900 dark:text-gray-300">
                            Data di rilascio
                        </label>
                        <x-input name="data_rilascio" type="date" id="data_rilascio" value="{{ old('data_rilascio') }}"
                                 required></x-input>
                    </div>
                </div>
                <div class="flex flex-wrap justify-between">
                    <div class="w-1/2 pr-3">
                        <label for="responsabile_id"
                               class="block  text-sm font-medium text-gray-900 dark:text-gray-300">Responsabile</label>
                        <x-select name="responsabile_id" id="responsabile_id">
                            <x-slot name="slot">
                                @foreach($ricercatori as $ricercatore)
                                    <option value="{{$ricercatore->id}}">
                                        {{$ricercatore->nome}} {{$ricercatore->cognome}}
                                    </option>
                                @endforeach
                            </x-slot>
                        </x-select>
                    </div>
                    <div class="w-1/2">
                        <label for="progetto_id"
                               class="block  text-sm font-medium text-gray-900 dark:text-gray-300">Progetto</label>
                        <x-select name="progetto_id" id="progetto_id">
                            <x-slot name="slot">
                                @if(request()->get('progetto') != null)
                                    <option value="{{\App\Models\Progetto::find(request()->get('progetto'))->id}}" selected>
                                        {{\App\Models\Progetto::find(request()->get('progetto'))->titolo}}
                                    </option>
                                @else
                                    @foreach($progetti as $progetto)
                                        <option value="{{$progetto->id}}">
                                            {{$progetto->titolo}}
                                        </option>
                                    @endforeach
                                @endif
                            </x-slot>
                        </x-select>
                    </div>
                </div>
                <x-button type="submit" class="mt-6">
                    Crea sotto progetto
                </x-button>
            </form>
        </div>
    </div>
@endsection
