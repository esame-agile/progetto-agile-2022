@extends('layouts.main')
@section('content')
    <div class="container mx-auto">
        <!--- Copertina del profilo --->
        <x-profile>
            <x-slot name="nome">
                {{$ricercatore->nome}} {{$ricercatore->cognome}}
                @auth()
                    {{-- Pulsante per editare informazioni personali --}}
                    <a href="{{route('ricercatore.edit', $ricercatore)}}"><i
                            class="lni lni-pencil"></i></a>
                @endauth
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
                    <x-slot name="pulsanti_up">
                        <x-button>
                            <a href="{{route('pubblicazioni.create',$ricercatore)}}">
                                AGGIUNGI
                            </a>
                        </x-button>
                        <x-button>
                            <a href="{{route('pubblicazioni.edit',$ricercatore)}}">
                                VISIBILITA'
                            </a>
                        </x-button>
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
                        <x-th class="resp1024">Tipologia</x-th>
                        <x-th class="resp640">Progetto</x-th>
                        <x-th>File</x-th>
                        <x-th>Azioni</x-th>
                    </x-slot>
                    <x-slot name="righe">
                        @if(isset($pubblicazioni))
                            @if($pubblicazioni->isEmpty())
                                <x-tr>
                                    <x-td>-</x-td>
                                    <x-td>-</x-td>
                                    <x-td class="resp1024">-</x-td>
                                    <x-td class="resp640">-</x-td>
                                    <x-td>-</x-td>
                                    <x-td>-</x-td>
                                </x-tr>
                            @else
                                @foreach($pubblicazioni as $pubblicazione)
                                    <x-tr>
                                        <x-td>{{$pubblicazione->doi}}</x-td>
                                        @if($pubblicazione->sorgente != "api")
                                            <x-td><a class="underline"
                                                     href="{{route("pubblicazione.show", $pubblicazione)}}">{{$pubblicazione->titolo}}
                                                </a>
                                            </x-td>
                                        @else
                                            <x-td>{{$pubblicazione->titolo}}</x-td>
                                        @endif
                                        <x-td class="resp1024">{{$pubblicazione->tipologia}}</x-td>
                                        <x-td class="resp640">{{$pubblicazione->progetto}}</x-td>
                                        @if($pubblicazione->sorgente != "api")
                                            <x-td>
                                                <a class="underline" href="{{route('pubblicazioni.download', $pubblicazione->file_name)}}">
                                                    {{$pubblicazione->file_name}}
                                                </a>
                                            </x-td>
                                        @else
                                            <x-td>-</x-td>
                                        @endif
                                        @if($pubblicazione->sorgente != "api")
                                            <x-td>
                                                <form method="POST"
                                                      class="float-right"
                                                      action="{{ route('pubblicazioni.destroy', $pubblicazione) }}"
                                                      id="delete_progetto"
                                                      name="delete_progetto"
                                                      onsubmit="confirm('Sei sicuro di voler cancellare?')">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit">
                                                        <i class="lni lni-trash"></i>
                                                    </button>
                                                </form>
                                            </x-td>
                                        @else
                                            <x-td>
                                                -
                                            </x-td>
                                        @endif
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
