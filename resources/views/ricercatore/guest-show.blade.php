@extends('layouts.main')
@section('content')

    <div class="container mx-auto">
        <!--- Copertina del profilo --->
        <x-profile>
            <x-slot name="nome">
                {{$ricercatore->nome}} {{$ricercatore->cognome}}
            </x-slot>
            <x-slot name="info">
                <x-li>
                    <span class="font-bold">Ambito di ricerca:</span> <br>
                    {{$ricercatore->ambito_ricerca}}
                </x-li>
                <x-li>
                    <span class="font-bold">Università:</span> <br>
                    {{$ricercatore->universita}}
                </x-li>
            </x-slot>
            <x-slot name="profile_picture">
                <div class="profile-picture">
                    <!--- Immagine del profilo --->
                </div>
            </x-slot>
            <x-slot name="contatti">
                <x-li>
                    <span class="font-bold">Contatti:</span> <br>
                    {{$ricercatore->email}}
                </x-li>
            </x-slot>
            <!--- Fine copertina del profilo --->
            <x-slot name="pubblicazioni">
                <x-table>
                    <x-slot name="titolo">
                        PUBBLICAZIONI
                    </x-slot>
                    <x-slot name="link">
                        @if(isset($pubblicazioni))
                            <div class="px-5 pb-5">
                                {{$pubblicazioni->links()}}
                            </div>
                        @endif
                    </x-slot>
                    <x-slot name="colonne">
                        <x-th>DOI</x-th>
                        <x-th>Titolo</x-th>
                        <x-th>Progetto</x-th>
                    </x-slot>
                    <x-slot name="righe">
                        @if(isset($pubblicazioni))
                            @if($pubblicazioni->isEmpty())
                                <x-tr>
                                    <x-td>-</x-td>
                                    <x-td>-</x-td>
                                    <x-td>-</x-td>
                                </x-tr>
                            @else
                                @foreach($pubblicazioni as $pubblicazione)
                                    <x-tr>
                                        <x-td>{{$pubblicazione->doi}}</x-td>
                                        <x-td>
                                            <a class="underline"
                                                 href="{{route("pubblicazioni.show", compact('pubblicazione'))}}">
                                                {{$pubblicazione->titolo}}
                                            </a>
                                        </x-td>
                                        <x-td class="resp640">
                                            <a class="underline"
                                               href="{{route("progetto.show", $pubblicazione->progetto)}}">
                                                {{$pubblicazione->progetto->titolo}}
                                            </a>
                                            </x-td>
                                    </x-tr>
                                @endforeach
                            @endif
                        @endif
                    </x-slot>
                </x-table>
            </x-slot>
            <x-slot name="progetti">
                <x-table>
                    <x-slot name="titolo">
                        PROGETTI
                    </x-slot>
                    <x-slot name="link">
                        @if(isset($progetti))
                            <div class="px-5 pb-5">
                                {{$progetti->links()}}
                            </div>
                        @endif
                    </x-slot>
                    <x-slot name="colonne">
                        <x-th>Titolo</x-th>
                        <x-th>Scopo</x-th>
                    </x-slot>
                    <x-slot name="righe">
                        @if(isset($progetti))
                            @if($progetti->isEmpty())
                                <x-tr>
                                    <x-td>-</x-td>
                                    <x-td>-</x-td>
                                </x-tr>
                            @else
                                @foreach($progetti as $progetto)
                                    <x-tr>
                                        <x-td><a class="underline"
                                                 href="{{route("progetto.show", $progetto)}}">{{$progetto->titolo}}
                                            </a>
                                        </x-td>
                                        <x-td>{{$progetto->scopo}}</x-td>
                                    </x-tr>
                                @endforeach
                            @endif
                        @endif
                    </x-slot>
                </x-table>
            </x-slot>
        </x-profile>

    </div>
@endsection
