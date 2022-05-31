@extends('layouts.main')
@section('content')
    <div class="container mx-auto">
        <x-table>
            <x-slot name="titolo">
                @if(isset($mieiProgetti))
                    I MIEI PROGETTI
                @else
                    ELENCO PROGETTI
                @endif
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
                <x-th class="resp640">Scopo</x-th>
                <x-th class="resp1024">Data inizio</x-th>
                <x-th class="resp1024">Data fine</x-th>
                @auth
                    @if(Auth::user()->ruolo == 'manager')
                        <x-th>Azioni</x-th>
                    @endif
                @endauth
            </x-slot>
            <x-slot name="righe">
                @if(isset($progetti))
                    @if($progetti->isEmpty())
                        <x-tr>
                            <x-td class="resp640">-</x-td>
                            <x-td class="resp1024">-</x-td>
                            <x-td class="resp1024">-</x-td>
                            @auth
                                @if(Auth::user()->ruolo == 'manager')
                                    <x-td class="text-center">-</x-td>
                                @endif
                            @endauth
                        </x-tr>
                    @else
                        @foreach($progetti as $progetto)
                            <x-tr>
                                <x-td><a class="underline"
                                         href="{{route("progetto.show", $progetto)}}">{{$progetto->titolo}}
                                    </a>
                                    @if(Auth::user()->id == $progetto->responsabile_id)
                                        <x-td><i class="lni lni-crown flex justify-center"></i></x-td>
                                    @endif
                                </x-td>
                                <x-td class="resp640">{{$progetto->scopo}}</x-td>
                                <x-td class="resp1024"> {{$progetto->data_inizio}}</x-td>
                                <x-td class="resp1024">{{$progetto->data_fine}}</x-td>
                                @auth()
                                    @if(Auth::user()->ruolo == 'manager')
                                        <x-td>
                                            <a href="{{ route('progetto.edit', $progetto) }}"><i
                                                    class="lni lni-pencil float-left"></i></a>
                                            <form method="POST"
                                                  class="float-right"
                                                  action="{{ route('progetto.destroy', $progetto) }}"
                                                  id="delete_progetto"
                                                  name="delete_progetto"
                                                  onsubmit="confirm('Sei sicuro di voler cancellare?')">
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit"><i class="lni lni-trash"></i>
                                                </button>
                                            </form>
                                        </x-td>
                                    @endif
                                @endauth
                            </x-tr>
                        @endforeach
                    @endif
                @endif
            </x-slot>
            <x-slot name="pulsanti">
                @if(isset($mieiProgetti))
                    <x-button class="mt-5">
                        <a href="{{route("ricercatore.sotto-progetti")}}">
                            I MIEI SOTTOPROGETTI
                        </a>
                    </x-button>
                @else
                    <x-button class="mt-5">
                        <a href="{{route("sotto-progetto.index")}}">
                            SOTTOPROGETTI
                        </a>
                    </x-button>
                @endif
            </x-slot>
        </x-table>
    </div>
@endsection
