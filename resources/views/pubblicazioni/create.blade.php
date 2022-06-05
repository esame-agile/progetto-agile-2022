@extends('layouts/main')
@section('content')
    <div class="container mx-auto">
        <x-form>
            <x-slot name="title">
                NUOVA PUBBLICAZIONE
            </x-slot>
            <x-slot name="form">
                <form method="POST" name="pubblicazione_create" id="pubblicazione_create" enctype="multipart/form-data"
                      action="{{ route('pubblicazioni.store') }}">
                    @csrf
                    @method('POST')
                    <div class="flex flex-wrap justify-between">
                        <div class="w-2/3 pr-3">
                            <div class="mb-6 flex flex-wrap justify-between">
                                <div class="w-1/2 pr-3">
                                    <x-label for="doi">DOI</x-label>
                                    <x-input name="doi" type="text" id="doi" value="{{ old('doi') }}"
                                             required></x-input>
                                </div>
                                <div class="w-1/2">
                                    <x-label for="titolo">Titolo</x-label>
                                    <x-input name="titolo" type="text" id="titolo" value="{{ old('titolo') }}"
                                             required></x-input>
                                </div>
                            </div>

                            <div class="mb-6 flex flex-wrap justify-between">
                                <div class="w-full">
                                    <x-label for="autori_esterni">Autori esterni al sito</x-label>
                                    <x-input name="autori_esterni" type="text" id="autori_esterni"
                                             value="{{ old('autori_esterni') }}" required></x-input>
                                </div>
                            </div>
                            <div class="mb-6 flex flex-wrap justify-between">
                                <div class="w-1/2 pr-3">
                                    <x-label for="tipologia">Tipologia</x-label>
                                    <x-select name="tipologia" id="tipologia" value="{{ old('tipologia') }}" required>
                                        <option selected disabled value="">Seleziona una tipologia...</option>
                                        <option value="Giornale">Giornale</option>
                                        <option value="Conferenza">Conferenza</option>
                                        <option value="Workshop">Workshop</option>
                                        <option value="Capitolo di un libro">Capitolo di un libro</option>
                                        <option value="Libro">Libro</option>
                                    </x-select>
                                </div>
                                <div class="w-1/2">
                                    <x-label for="progetto_id">Progetto associato</x-label>
                                    <x-select name="progetto_id" id="progetto_id" value="{{ old('progetto_id') }}"
                                              required>
                                        <option selected disabled value="">Seleziona il progetto...</option>
                                        @foreach($progetti as $progetto)
                                            <option value="{{$progetto->id}}">{{$progetto->titolo}}</option>
                                        @endforeach
                                    </x-select>
                                </div>
                            </div>
                        </div>

                        <div class="w-1/3">
                            <x-label for="ricercatori">Ricercatori associati</x-label>
                            <ul class="scroll-py-1 text-sm text-gray-700 dark:text-gray-200 max-h-64 overflow-y-scroll">
                                @foreach($ricercatori as $ricercatore)
                                    @if($ricercatore->id == $autore->id)
                                        <label>
                                            <input type="hidden" name="ricercatori[]"
                                                   form="pubblicazione_create"
                                                   tabindex="-1"
                                                   value="{{$ricercatore->id}}" checked>
                                        </label>
                                    @else
                                        <li class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                            <label>
                                                <input type="checkbox" name="ricercatori[]"
                                                       form="pubblicazione_create"
                                                       value="{{$ricercatore->id}}">
                                                {{$ricercatore->nome}} {{$ricercatore->cognome}}
                                            </label>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="w-2/6 mb-10">
                            <x-label for="file_name">File</x-label>
                            <input name="file_name" type="file" id="file_name" value="{{ old('file_name') }}"
                                   class="h-11"
                                   required>
                        </div>
                    </div>
                    <x-button type="submit"> CREA</x-button>
                </form>
            </x-slot>
        </x-form>
    </div>
@endsection
