@extends('layouts/main')
@include('layouts.alert-message')
@section('content')

    <div id="home" class="relative z-10 header-hero">
        <div class="container">
            <div class="justify-center row">
                <div class="w-full lg:w-5/6 xl:w-2/3">
                    <div class="pt-5 pb-64 header-content"> <!-- pt padding top -->

                        <form class="" id="creazioneP" method="POST" action="{{ route('pubblicazioni.store') }}">
                            @csrf
                            @method('POST')
                            <div class="mb-6">
                                <div class="flex justify-around">
                                    <div class="inline-block">
                                        <label for="doi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 flex justify-center">DOI:</label>
                                        <x-input name="doi" type="text" value="{{ old('doi') }}" id="doi" placeholder="DOI"></x-input>
                                    </div>
                                    <div class="inline-block">
                                        <label for="titolo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 flex justify-center">Titolo:</label>
                                        <x-input name="titolo" type="text" value="{{ old('titolo') }}" id="titolo" placeholder="Titolo pubblicazione"></x-input>
                                    </div>
                                    <div class="inline-block">
                                        <label for="autori_esterni" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 flex justify-center">Autori non registrati nel sito:</label>
                                        <x-input name="autori_esterni" type="text" value="{{ old('autori_esterni') }}" id="autori_esterni" placeholder="Autori esterni"> </x-input>
                                    </div>
                                </div>
                            </div>

                        </form>
                        <div class="mt-4 ml-64 form-control inline-block justify-center">
                            <label for="tipologia" class=" mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 ">Tipologia:</label>
                            <select name="tipologia" form="creazioneP">
                                <option selected disabled value="">Seleziona una tipologia...</option>
                                <option value="Giornale">Giornale</option>
                                <option value="Conferenza">Conferenza </option>
                                <option value="Workshop">Workshop </option>
                                <option value="Capitolo di un libro">Capitolo di un libro </option>
                                <option value="Libro">Libro </option>
                            </select>
                        </div>
                        <div class="mt-4 ml-64 form-control inline-block justify-center">
                            <label for="progetto_id" class=" mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 ">Progetto:</label>
                            <select name="progetto_id" form="creazioneP">
                                <option selected disabled value="">Seleziona il progetto...</option>
                                @foreach($progetti as $progetto)
                                    <option value="{{$progetto->id}}">{{$progetto->titolo}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-center">
                                <label><strong>Ricercatori :</strong></label>
                            <div class="form-check">
                                @foreach($ricercatori as $ricercatoricheck)
                                    @if($ricercatoricheck->id==$ricercatore->id)
                                        <br> <label><input type="checkbox" name="ricercatori[]" value="{{$ricercatoricheck->id}}" form="creazioneP" checked> {{$ricercatoricheck->nome}} {{$ricercatoricheck->cognome}}</label>
                                    @else
                                <br> <label><input type="checkbox" name="ricercatori[]" value="{{$ricercatoricheck->id}}" form="creazioneP"> {{$ricercatoricheck->nome}} {{$ricercatoricheck->cognome}}</label>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="pt-10 flex items-center justify-center">
                            <x-button type="submit" form="creazioneP"> CREA </x-button>
                        </div>
                        </div>


                    </div> <!-- header content -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- header content -->

@endsection
