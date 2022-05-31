@extends('layouts.main')
@section('content')
    <div class="container mx-auto">
        <!--- Copertina del profilo --->
        <x-profile>
            <x-slot name="nome">
                {{$finanziatore->nome}} {{$finanziatore->cognome}}
                @auth()
                    {{-- Pulsante per editare informazioni personali --}}
                    <a href="{{route('finanziatore.edit', $finanziatore)}}"><i
                            class="lni lni-pencil"></i></a>
                @endauth
            </x-slot>
            <x-slot name="info">
                <x-li>
                    <span class="font-bold">Ambito di ricerca:</span> <br>
                    {{$finanziatore->nome_azienda}}
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
                    {{$finanziatore->email}}
                </x-li>
            </x-slot>
            <!--- Fine copertina del profilo --->
            <x-slot name="progetti">
                <x-table>
                    <x-slot name="titolo">
                        PROGETTI FINANZIATI
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
                        <x-th class="resp640">Data inizio</x-th>
                        <x-th class="resp640">Data fine</x-th>
                    </x-slot>
                    <x-slot name="righe">
                        @if(isset($progetti))
                            @if($progetti->isEmpty())
                                <x-tr>
                                    <x-td>-</x-td>
                                    <x-td>-</x-td>
                                    <x-td class="resp640">-</x-td>
                                    <x-td class="resp640">-</x-td>
                                </x-tr>
                            @else
                                @foreach($progetti as $progetto)
                                    <x-tr>
                                        <x-td><a class="underline"
                                                 href="{{route("progetto.show", $progetto)}}">{{$progetto->titolo}}
                                            </a>
                                        </x-td>
                                        <x-td>{{$progetto->scopo}}</x-td>
                                        <x-td class="resp640">{{$progetto->data_inizio}}</x-td>
                                        <x-td class="resp640">{{$progetto->data_fine}}</x-td>
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
