@extends('layouts.main')
@section('content')
    <div class="container mx-auto">
        <div class="card top">
            <div class="flex flex-wrap justify-center">
                <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
                </div>
                <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
                    <div class="py-6 px-3 mt-32 sm:mt-0">
                    </div>
                </div>
                <div class="w-full lg:w-4/12 px-4 lg:order-1">
                    <div class="flex justify-center py-4 lg:pt-4 pt-8">
                    </div>
                </div>
                <div class="text-center mt-12 w-full">
                    <h3 class="text-4xl font-semibold leading-normal mb-2 text-blueGray-700 mb-2">
                        {{$progetto->titolo}}
                    </h3>
                    <div class="text-sm leading-normal mt-0 mb-2 text-blueGray-700 font-bold uppercase">
                        {{$progetto->scopo}}
                    </div>
                    <div class="mb-2 text-blueGray-700 mt-5">
                        Data di inizio
                    </div>
                    <div class="mb-2 text-blueGray-600 mt-2">
                        {{$progetto->data_inizio}}
                    </div>
                    <div class="mb-2 text-blueGray-700 mt-2">
                        Data di fine
                    </div>
                    <div class="mb-2 text-blueGray-600 mt-2">
                        {{$progetto->data_fine}}
                    </div>
                </div>
                <div class="mt-10 py-10 border-t border-blueGray-200 text-center w-full">
                    <div class="text-center mt-12">
                        <div class="text-sm leading-normal mt-0 mb-2 text-blueGray-700 font-bold uppercase">
                            In cosa consiste
                        </div>
                        <div class="flex flex-wrap justify-center">
                            <div class="w-full lg:w-9/12 px-4">
                                <p class="mb-4 text-lg leading-relaxed text-blueGray-700">
                                    {{$progetto->descrizione}}
                                </p>
                                <div class="mt-10 py-10 border-t border-blueGray-200 text-center w-full">
                                    <div class="text-center mt-12 ">
                                        <h3 class=" text-xl font-semibold leading-normal mb-2 text-blueGray-700 mb-2">
                                            Ricercatori</h3>
                                    </div>
                                </div>

                                <!--- Ricercatori--->
                                @auth
                                    @if(Auth::user()->id == $progetto->responsabile_id)
                                        <x-button class="mb-10">
                                            <a href="{{route("progetto.edit-ricercatori", compact("progetto"))}}">
                                                MODIFICA RICERCATORI
                                            </a>
                                        </x-button>
                                    @endif
                                @endauth
                                <div class="card tabella">
                                    <section class="container mx-fit p-6 font-semibold">
                                        <div class="w-full overflow-hidden rounded-lg shadow-lg">
                                            <div class="w-full overflow-x-auto">
                                                <table class="w-full">
                                                    <thead>
                                                    <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                                        <th class="px-4 py-3 text-center">
                                                            Nome
                                                        </th>
                                                        <th class="px-4 py-3 responsive text-center">
                                                            Cognome
                                                        </th>
                                                        <th class="px-4 py-3 responsive text-center">
                                                            Ambito ricerca
                                                        </th>
                                                        <th class="px-4 py-3 responsive text-center">
                                                            Università
                                                        </th>
                                                    </tr>
                                                    </thead>
                                                    <tbody class="bg-white">
                                                    @if($ricercatori==!null)
                                                        @foreach($ricercatori as $ricercatore)
                                                            <tr class="text-gray-700">
                                                                <th class="px-4 py-3">
                                                                    <a href="{{route("ricercatore.guest-show", $ricercatore)}}">{{$ricercatore->nome}}</a>
                                                                </th>
                                                                <th class="px-4 py-3">
                                                                    {{$ricercatore->cognome}}
                                                                </th>
                                                                <th class="px-4 py-3">
                                                                    {{$ricercatore->ambito_ricerca}}
                                                                </th>
                                                                <th class="px-4 py-3">
                                                                    {{$ricercatore->universita}}
                                                                </th>
                                                            </tr>
                                                        @endforeach
                                                    @endif


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>  <!-- fine container -->
                                    </section>
                                </div>
                                <!--- Fine ricercatori --->
                                <div class="mt-10 py-10 border-t border-blueGray-200 text-center w-full">
                                    <div class="text-center mt-12">
                                        <h3 class=" text-xl font-semibold leading-normal mb-2 text-blueGray-700 mb-2">
                                            Progetti affiliati</h3>
                                    </div>
                                </div>
                                <!--- Progetti affiliati --->
                                @auth
                                    @if(Auth::user()->hasRuolo("manager"))
                                        <x-button class="mb-10">
                                            <a href="{{route("sotto-progetto.create")}}">
                                                CREA SOTTOPROGETTO
                                            </a>
                                        </x-button>
                                    @endif
                                @endauth
                                <div class="card tabella">
                                    <section class="container mx-fit p-6 font-semibold">
                                        <div class="w-full overflow-hidden rounded-lg shadow-lg">
                                            <div class="w-full overflow-x-auto">
                                                <table class="w-full">
                                                    <thead>
                                                    <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                                        <th class="px-4 py-3 text-center">
                                                            Titolo
                                                        </th>
                                                        <th class="px-4 py-3 responsive text-center">
                                                            Data di rilascio
                                                        </th>

                                                    </tr>
                                                    </thead>
                                                    <tbody class="bg-white">

                                                    @if($sotto_progetti==!null)
                                                        @foreach($sotto_progetti as $sotto_progetto)
                                                            <tr class="text-gray-700">
                                                                <th class="px-4 py-3">
                                                                    <a href="{{route("sotto-progetto.show", ["sotto-progetto"=>$sotto_progetto])}}"> {{$sotto_progetto->titolo}} </a>
                                                                </th>
                                                                <th class="px-4 py-3">
                                                                    {{$sotto_progetto->data_rilascio}}
                                                                </th>
                                                            </tr>
                                                        @endforeach
                                                    @endif

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>  <!-- fine container -->
                                    </section>
                                    <!--- Pubblicazioni del progetto--->
                                    <div class="text-center mt-12">
                                        <h3 class=" text-xl font-semibold leading-normal mb-2 text-blueGray-700 mb-2">
                                            Pubblicazioni relative al progetto</h3>
                                    </div>
                                    <div class="card tabella">
                                        <section class="container mx-fit p-6 font-semibold">
                                            <div class="w-full overflow-hidden rounded-lg shadow-lg">
                                                <div class="w-full overflow-x-auto">
                                                    <table class="w-full">
                                                        <thead>
                                                        <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                                            <th class="px-4 py-3 text-center">
                                                                DOI
                                                            </th>
                                                            <th class="px-4 py-3 responsive text-center">
                                                                Titolo
                                                            </th>
                                                            <th class="px-4 py-3 responsive text-center">
                                                                Tipologia
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody class="bg-white">
                                                        @if($pubblicazioni==!null)
                                                            @foreach($pubblicazioni as $pubblicazione)
                                                                <tr class="text-gray-700">
                                                                    <th class="px-4 py-3">
                                                                        {{$pubblicazione->doi}}
                                                                    </th>
                                                                    <th class="px-4 py-3">
                                                                        {{$pubblicazione->titolo}}
                                                                    </th>
                                                                    <th class="px-4 py-3">
                                                                        {{$pubblicazione->tipologia}}
                                                                    </th>
                                                                </tr>
                                                            @endforeach
                                                        @endif


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>  <!-- fine container -->
                                        </section>
                                    </div>
                                    <!--- Fine ricercatori --->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
