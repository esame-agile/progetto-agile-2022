@extends('layouts.main')
@section('content')
    <div class="container mx-auto">
        <div class="flex flex-wrap justify-between mb-10">
            <div class="card-grey lg:w-5/12 h-full">
                <div class="card-white px-5 py-5">
                    <h3 class="text-4xl font-semibold leading-normal text-blueGray-700 uppercase">
                        {{$progetto->titolo}}
                    </h3>
                </div>
                <div class="card-white mt-5 px-5 py-5">
                    <div class="text-sm leading-normal text-blueGray-700 font-bold uppercase">
                        SCOPO:
                    </div>
                    <div class="text-blueGray-700">
                        {{$progetto->scopo}}
                    </div>
                    <div class="text-sm leading-normal text-blueGray-700 font-bold uppercase">
                        DATA D'INIZIO:
                    </div>
                    <div class="text-blueGray-700">
                        {{$progetto->data_inizio}}
                    </div>
                    <div class="text-sm leading-normal text-blueGray-700 font-bold uppercase">
                        DATA DI FINE:
                    </div>
                    <div class="text-blueGray-700">
                        {{$progetto->data_fine}}
                    </div>
                </div>
            </div>
            <div class="lg:w-6/12">
                <x-table>
                    <x-slot name="titolo_interno">
                        ELENCO RICERCATORI
                    </x-slot>
                    <x-slot name="pulsanti_up_interno">
                        @auth
                            @if(Auth::user()->id == $progetto->responsabile_id)
                                <x-button class="mb-10">
                                    <a href="{{route("progetto.edit-ricercatori", compact("progetto"))}}">
                                        MODIFICA RICERCATORI
                                    </a>
                                </x-button>
                            @endif
                        @endauth
                    </x-slot>
                    <x-slot name="link">
                        @if(isset($ricercatori))
                            <div class="px-5 pb-5">
                                {{$ricercatori->links()}}
                            </div>
                        @endif
                    </x-slot>
                    <x-slot name="colonne">
                        <x-th>Nome</x-th>
                        <x-th>Ambito ricerca</x-th>
                        <x-th class="resp640">Università</x-th>
                    </x-slot>
                    <x-slot name="righe">
                        @if(isset($ricercatori))
                            @if($ricercatori->isEmpty())
                                <x-tr>
                                    <x-td class="text-left">-</x-td>
                                    <x-td class="text-left">-</x-td>
                                    <x-td class="text-left resp640">-</x-td>
                                </x-tr>
                            @else
                                @foreach($ricercatori as $ricercatore)
                                    <x-tr>
                                        <x-td>
                                            <a class="underline"
                                               href="{{route("ricercatore.guest-show", $ricercatore)}}">
                                                {{$ricercatore->nome . ' ' . $ricercatore->cognome}}
                                            </a>
                                        </x-td>
                                        <x-td>{{$ricercatore->ambito_ricerca}}</x-td>
                                        <x-td class="resp640">{{$ricercatore->universita}}</x-td>
                                    </x-tr>
                                @endforeach
                            @endif
                        @endif
                    </x-slot>
                </x-table>
            </div>
        </div>
        <div class="flex flex-wrap justify-between">
            <div class="lg:w-5/12">
                <x-table>
                    <x-slot name="titolo_interno">
                        ELENCO PUBBLICAZIONI
                    </x-slot>
                    <x-slot name="link">
                        @if(isset($pubblicazioni))
                            <div class="px-5 pb-5">
                                {{$pubblicazioni->links()}}
                            </div>
                        @endif
                    </x-slot>
                    <x-slot name="colonne">
                        <x-th>Titolo</x-th>
                        @if(Auth::user()->ruolo =='ricercatore')
                            <x-th>Visibile</x-th>
                        @endif
                    </x-slot>
                    <x-slot name="righe">
                        @if(isset($pubblicazioni))
                            @if($pubblicazioni->isEmpty())
                                <x-tr>
                                    <x-td class="text-left">-</x-td>
                                    @if(Auth::user()->ruolo == 'ricercatore')
                                        <x-td class="text-left">-</x-td>
                                    @endif
                                </x-tr>
                            @else
                                @foreach($pubblicazioni as $pubblicazione)
                                    <x-tr>
                                        <x-td>
                                            <a class="underline"
                                               href="{{route("pubblicazione.show", $pubblicazione)}}">
                                                {{$pubblicazione->titolo}}
                                            </a>
                                        </x-td>
                                        @if(Auth::user()->ruolo == 'ricercatore')
                                            <x-td>{{$pubblicazione->visibile}}</x-td>
                                        @endif
                                    </x-tr>
                                @endforeach
                            @endif
                        @endif
                    </x-slot>
                </x-table>
            </div>
            <div class="lg:w-6/12">
                <x-table>
                    <x-slot name="titolo_interno">
                        ELENCO SOTTO PROGETTI
                    </x-slot>
                    <x-slot name="link">
                        @if(isset($sottoProgetti))
                            <div class="px-5 pb-5">
                                {{$sottoProgetti->links()}}
                            </div>
                        @endif
                    </x-slot>
                    <x-slot name="pulsanti_up_interno">
                        @auth
                            @if(Auth::user()->hasRuolo("manager"))
                                <x-button class="mb-10">
                                    <a href="{{route("sotto-progetto.create")}}">
                                        CREA SOTTOPROGETTO
                                    </a>
                                </x-button>
                            @endif
                        @endauth
                    </x-slot>
                    <x-slot name="colonne">
                        <x-th>Titolo</x-th>
                        <x-th>Data rilascio</x-th>
                    </x-slot>
                    <x-slot name="righe">
                        @if(isset($sottoProgetti))
                            @if($sottoProgetti->isEmpty())
                                <x-tr>
                                    <x-td class="text-left">-</x-td>
                                    <x-td class="text-left">-</x-td>
                                    <x-td class="text-left resp640">-</x-td>
                                </x-tr>
                            @else
                                @foreach($sottoProgetti as $sottoProgetto)
                                    <x-tr>
                                        <x-td>
                                            <a class="underline"
                                               href="{{route("ricercatore.guest-show", $sottoProgetto)}}">
                                                {{$sottoProgetto->titolo}}
                                            </a>
                                        </x-td>
                                        <x-td>{{$sottoProgetto->data_rilascio}}</x-td>
                                    </x-tr>
                                @endforeach
                            @endif
                        @endif
                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
@endsection
