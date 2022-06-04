@extends('layouts.main')
@section('content')
    <div class="container mx-auto">
        <div class="row">
            <div class="lg:w-6/12 pr-5 column">
                <!-----Descrizione----->
                <div class="card-grey mb-10">
                    <div class="card-white px-5 py-5">
                        <h3 class="text-4xl font-semibold leading-normal text-blueGray-700 uppercase">
                            {{$pubblicazione->titolo}}
                        </h3>
                    </div>
                    <div class="card-white mt-5 px-5 py-5">
                        <div class="text-sm leading-normal text-blueGray-700 font-bold uppercase">
                            DOI:
                        </div>
                        <div class="text-blueGray-700">
                            {{$pubblicazione->doi}}
                        </div>
                        <div class="text-sm leading-normal text-blueGray-700 font-bold uppercase">
                            TIPOLOGIA:
                        </div>
                        <div class="text-blueGray-700">
                            {{$pubblicazione->tipologia}}
                        </div>
                        <div class="text-sm leading-normal text-blueGray-700 font-bold uppercase">
                            AUTORI ESTERNI:
                        </div>
                        <div class="text-blueGray-700">
                            {{$pubblicazione->autori_esterni}}
                        </div>
                        <div class="text-sm leading-normal text-blueGray-700 font-bold uppercase">
                            PROGETTO ASSOCIATO:
                        </div>
                        <div class="text-blueGray-700">
                            <a class="underline" href="{{route("progetto.show", $pubblicazione->progetto)}}">
                                {{$pubblicazione->progetto->titolo}}
                            </a>
                        </div>
                        <div class="text-sm leading-normal text-blueGray-700 font-bold uppercase">
                            FILE:
                        </div>
                        <div class="text-blueGray-700">
                            <a class="underline" href="{{route("pubblicazioni.download", $pubblicazione->file_name)}}">
                                {{$pubblicazione->file_name}}
                            </a>
                        </div>
                    </div>
                </div>
                <!-----Fine Descrizione----->
            </div>


            <div class="lg:w-6/12 pl-5 column">
                <!-----Ricercatori----->
                <x-table>
                    <x-slot name="titolo_interno">
                        ELENCO AUTORI
                    </x-slot>
                    <x-slot name="link">
                        @if(isset($autori))
                            <div class="px-5 pb-5">
                                {{$autori->links()}}
                            </div>
                        @endif
                    </x-slot>
                    <x-slot name="colonne">
                        <x-th>Nome</x-th>
                        <x-th>Ambito ricerca</x-th>
                        <x-th class="resp640">Università</x-th>
                    </x-slot>
                    <x-slot name="righe">
                        @if(isset($autori))
                            @if($autori->isEmpty())
                                <x-tr>
                                    <x-td class="text-left">-</x-td>
                                    <x-td class="text-left">-</x-td>
                                    <x-td class="text-left resp640">-</x-td>
                                </x-tr>
                            @else
                                @foreach($autori as $autore)
                                    <x-tr>
                                        <x-td>
                                            <a class="underline"
                                               href="{{route("ricercatore.guest-show", $autore)}}">
                                                {{$autore->nome . ' ' . $autore->cognome}}
                                            </a>
                                        </x-td>
                                        <x-td>{{$autore->ambito_ricerca}}</x-td>
                                        <x-td class="resp640">{{$autore->universita}}</x-td>
                                    </x-tr>
                                @endforeach
                            @endif
                        @endif
                    </x-slot>
                </x-table>
                <!-----Fine Ricercatori----->
            </div>
        </div>
    </div>
@endsection

