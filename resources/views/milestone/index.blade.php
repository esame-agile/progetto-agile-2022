@extends('layouts.main')
@section('content')
    <div class="container mx-auto">
        <x-table>
            <x-slot name="pulsanti_up">
                <x-button><a href="{{ route('milestone.create', $sottoProgetto) }}"><i
                            class="lni lni-plus"></i> Aggiungi Milestone</a></x-button>
            </x-slot>
            <x-slot name="titolo">
                Milestones del progetto {{ $sottoProgetto->titolo}}
            </x-slot>
            <x-slot name="link">
                @if(isset($milestones))
                    <div class="px-5 pb-5">
                        {{$milestones->links()}}
                    </div>
                @endif
            </x-slot>
            <x-slot name="colonne">
                <x-th>Descrizione</x-th>
                <x-th class="resp640">Data Evento</x-th>
                @if(!Auth::user()->hasRuolo("manager"))
                    <x-th>Azioni</x-th>
                @endif
            </x-slot>
            <x-slot name="righe">
                @if(isset($milestones))
                    @if($milestones->isEmpty())
                        <x-tr>
                            <x-td>-</x-td>
                            <x-td class="resp640">-</x-td>
                            @auth
                                @if(Auth::user()->ruolo == 'manager')
                                    <x-td>-</x-td>
                                @endif
                            @endauth
                        </x-tr>
                    @else
                        @foreach ($milestones as $milestone)
                            <x-tr>
                                <x-td>{{ $milestone->descrizione }}</x-td>
                                <x-td class="resp640">{{ date('d/m/Y', strtotime($milestone->data_evento )) }}</x-td>
                                @if(!Auth::user()->hasRuolo("manager"))
                                    <x-td class="flex flex-wrap justify-between">
                                        <a href="{{ route('milestone.edit', [$milestone->sotto_progetto->id, $milestone->id]) }}"><i
                                                class="lni lni-pencil"></i></a>
                                        <form method="POST"
                                              action="{{ route('milestone.destroy',[$milestone->sotto_progetto->id, $milestone->id])}}"
                                              id="delete_milestone"
                                              name="delete_milestone"
                                              onsubmit="confirm('Sei sicuro di voler cancellare?')">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit"><i class="lni lni-trash"></i></button>
                                        </form>
                                    </x-td>
                                @endif
                            </x-tr>
                        @endforeach
                    @endif
                @endif
            </x-slot>
        </x-table>
    </div>
@endsection
