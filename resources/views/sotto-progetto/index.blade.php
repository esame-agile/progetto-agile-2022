@extends('layouts.main')
@section('content')
    <div class="container mx-auto">
        <x-table>
            <x-slot name="titolo">
                @auth
                    @if(Auth::user()->hasRuolo('manager'))
                        <x-slot name="pulsanti_up">
                            <x-button><a href="{{ route('sotto-progetto.create') }}"><i
                                        class="lni lni-plus"></i> Aggiungi Sottoprogetto</a></x-button>
                        </x-slot>
                        @if(app('request')->input('progetto') !== null)
                            Elenco dei sotto progetti del progetto
                            {{ \App\Models\Progetto::find(app('request')->input('progetto'))->titolo }}
                        @else
                            Elenco di tutti i sottoprogetti
                        @endif
                    @elseif(Auth::user()->hasRuolo("ricercatore"))
                        @if(isset($mieiSottoProgetti))
                            Elenco dei sotto progetti a cui sei assegnato
                        @else
                            Elenco dei sotto progetti
                        @endif
                    @endif
                @else
                    Elenco dei sotto progetti
                @endif
            </x-slot>
            <x-slot name="link">
                @if(isset($sottoProgetti))
                    <div class="px-5 pb-5">
                        {{$sottoProgetti->links()}}
                    </div>
                @endif
            </x-slot>
            <x-slot name="colonne">
                <x-th>Titolo</x-th>
                <x-th class="resp640">Descrizione</x-th>
                <x-th class="resp640">Data Rilascio</x-th>
                @auth
                    @if(Auth::user()->hasRuolo("manager") || Auth::user()->hasRuolo("ricercatore"))
                        <x-th class="text-center">Azioni</x-th>
                    @endif
                @endauth
            </x-slot>
            <x-slot name="righe">
                @if(isset($sottoProgetti))
                    @if($sottoProgetti->isEmpty())
                        <x-tr>
                            <x-td>-</x-td>
                            <x-td class="resp640">-</x-td>
                            <x-td class="resp640">-</x-td>
                            @auth
                                @if(Auth::user()->ruolo == 'manager' || Auth::user()->ruolo == 'ricercatore')
                                    <x-td class="text-center">-</x-td>
                                @endif
                            @endauth
                        </x-tr>
                    @else
                        @foreach ($sottoProgetti as $sottoProgetto)
                            <x-tr>
                                <x-td class="underline">
                                    <a href="{{route("sotto-progetto.show", $sottoProgetto)}}">
                                        {{$sottoProgetto->titolo}}
                                        @auth
                                            @if(Auth::user()->id == $sottoProgetto->responsabile_id)
                                                <i class="lni lni-crown float-right"></i>
                                            @endif
                                        @endauth
                                    </a>
                                </x-td>
                                <x-td class="resp640">{{ $sottoProgetto->descrizione }}</x-td>
                                <x-td class="resp640">
                                    {{ date('d/m/Y', strtotime($sottoProgetto->data_rilascio )) }}
                                </x-td>
                                @auth
                                    @if(Auth::user()->hasRuolo("manager"))
                                        <x-td>
                                            <div class="flex-wrap flex justify-between">
                                                <a href="{{ route('sotto-progetto.edit', $sottoProgetto) }}"><i
                                                        class="lni lni-pencil"></i></a>
                                                <form method="POST"
                                                      action="{{ route('sotto-progetto.destroy', $sottoProgetto) }}"
                                                      id="delete_sottoProgetto"
                                                      name="delete_sottoProgetto"
                                                      onsubmit="confirm('Sei sicuro di voler cancellare?')">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit"><i class="lni lni-trash"></i></button>
                                                </form>
                                            </div>
                                        </x-td>
                                    @else
                                        <x-td class="text-center">-</x-td>
                                    @endif
                                @endauth
                            </x-tr>
                        @endforeach
                    @endif
                @endif
            </x-slot>
        </x-table>
    </div>
@endsection
