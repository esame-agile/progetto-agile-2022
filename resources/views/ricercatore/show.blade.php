@extends('layouts.main')
@include('layouts.alert-message')
@section('content')

    <div class="container mx-auto">
        <!--- Copertina del profilo --->
        <div class="card-grey copertina-profilo">
            @yield('alert-message')
            <div class="card-body">
                <div class="profile-background">
                    <!--- Immagine di copertina del profilo --->
                </div>
                <div class="profile-picture">
                    <!--- Immagine del profilo --->
                </div>
                <div class="nome-utente-container">
                    <p class="testo grande">{{$ricercatore->nome}} {{$ricercatore->cognome}} </p>

                    <p class="testo">
                        {{$ricercatore->ambito_ricerca}}
                        <br>
                        {{$ricercatore->universita}}
                    </p>

                </div>
                <div class="contatti">
                    <p class="testo">
                        {{$ricercatore->email}}
                    </p>
                </div>
            </div>
            @auth()
                {{-- Pulsante per editare informazioni personali --}}
                <a href="{{route('ricercatore.edit', $ricercatore)}}"><i
                        class="lni lni-pencil edit"></i></a>
            @endauth
            <div class="contatti hidden">
                <p class="testo">
                    {{$ricercatore->email}}
                </p>
            </div>
        </div>
        <!--- Fine copertina del profilo --->

        <div class="mb-3">
            <h2 class="text-3xl font-bold leading-normal text-blueGray-700 mb-2 uppercase">Pubblicazioni</h2>
            <x-button class="">
                <a href="{{route('pubblicazioni.create',$ricercatore)}}">
                    AGGIUNGI PUBBLICAZIONE
                </a>
            </x-button>
            <x-button class="">
                <a href="{{route('pubblicazioni.edit',$ricercatore)}}">
                    RENDI VISIBILI O NASCONDI LE PUBBLICAZIONI
                </a>
            </x-button>
        </div>
        <div class="card-grey mb-10">
            <div class="w-full overflow-hidden rounded-lg shadow-lg">
                <div class="w-full overflow-x-auto">
                    <table class="w-full">
                        <thead>
                        <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                            <th class="px-3 py-2 text-left">
                                DOI
                            </th>
                            <th class="px-3 py-2 text-left">
                                Titolo
                            </th>
                            <th class="px-3 py-2 text-left">
                                Tipologia
                            </th>
                            <th class="px-3 py-2 text-left">
                                Progetto
                            </th>
                            <th class="px-3 py-2 text-left">
                                Visibile
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                        <tr class="text-gray-700">
                        @if($pubblicazioni != null)
                            {{ $pubblicazioni->links() }}
                            @if($pubblicazioni->isEmpty())
                                <tr class="text-gray-700">
                                    <td class="px-4 py-2 text-left">-</td>
                                    <td class="px-4 py-2 text-left">-</td>
                                    <td class="px-4 py-2 text-left">-</td>
                                    <td class="px-4 py-2 text-left">-</td>
                                    <td class="px-4 py-2 text-left">-</td>
                                </tr>
                            @else
                                @foreach($pubblicazioni as $pubblicazione)
                                    <tr class="text-gray-700">
                                        <th class="px-4 py-3 text-ms font-semibold border ">
                                            {{$pubblicazione->doi}}
                                        </th>
                                        <th class="px-4 py-3 text-ms font-semibold border ">
                                            {{$pubblicazione->titolo}}
                                        </th>
                                        <th class="px-4 py-3 text-ms font-semibold border ">
                                            {{$pubblicazione->tipologia}}
                                        </th>
                                        <th class="px-4 py-3 text-ms font-semibold border ">
                                            {{\App\Models\Progetto::find($pubblicazione->progetto_id)->titolo}}
                                        </th>

                                        <td class="px-4 py-3 text-ms font-semibold border">
                                            @if($pubblicazione->ufficiale==false)
                                                <i class="fa-solid fa-xmark "></i>
                                            @else
                                                <i class="fa-solid fa-check "></i>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
