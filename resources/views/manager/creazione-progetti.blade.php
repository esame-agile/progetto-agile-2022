@extends('layouts/main')

@section('content')

    <div id="home" class="relative z-10 header-hero">
        <div class="container">
            <div class="justify-center row">
                <div class="w-full lg:w-5/6 xl:w-2/3">
                    <div class="pt-5 pb-64 header-content"> <!-- pt padding top -->

                        <form class="" id="creazioneP" method="POST" action="{{ route('creaprogetto') }}">
                            @csrf
                            @method('POST')
                            <div class="mb-6">
                                <div class="flex justify-around">
                                    <div class="inline-block">
                                        <label for="titolo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 flex justify-center">Titolo:</label>
                                        <x-input name="titolo" type="text" id="titolo" placeholder="Nome del progetto"></x-input>
                                    </div>
                                    <div class="inline-block">
                                        <label for="scopo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 flex justify-center">Scopo:</label>
                                        <x-input name="scopo" type="text" id="scopo" placeholder="Scopo del progetto"> </x-input>
                                    </div>
                                </div>
                                <div class="ml-28 mr-28">
                                    <div class="mt-7" >
                                        <label for="descrizione flex justify-center" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Descrizione:</label>
                                        <x-input name="descrizione" type="text" id="descrizione" placeholder="Descrizione del progetto"> </x-input>
                                    </div>
                                </div>
                                <!-- QUANDO CI SARA' IL BUDGET
                                <div class="inline-block mt-3">
                                    <label for="budget" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Budget:</label>
                                    <x-input name="budget" type="number" step="any" id="budget" placeholder="Budget iniziale"> </x-input>
                                </div>
                                -->
                                <div class="mt-4 ml-64">
                                    <div class="inline-block mt-3 pr-20">
                                        <label for="datainizio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Data di inizio:</label>
                                        <x-input name="datainizio" type="date" id="datainizio" placeholder="Scegli data di inizio"> </x-input>
                                    </div>
                                    <div class="inline-block mt-3">
                                        <label for="datafine" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Data di fine:</label>
                                        <x-input name="datafine" type="date" id="datafine" placeholder="Scegli data di fine"> </x-input>
                                    </div>
                                </div>

                            </div>

                        </form>
                        <div class="mt-4 ml-64 form-control inline-block">
                            <label for="responsabile" class=" mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 ">Responsabile:</label>
                            <select name="selectRes" form="creazioneP">
                                <option selected disabled value="">Incarica ricercatore...</option>
                                @foreach($ricercatori as $ricercatore)
                                    <option value="{{$ricercatore->id}}">{{$ricercatore->nome}} {{$ricercatore->cognome}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="pt-10 flex items-center justify-center">
                            <x-button type="submit" form="creazioneP"> CREA </x-button>
                        </div>

                    </div> <!-- header content -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- header content -->

@endsection
