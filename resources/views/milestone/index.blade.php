@extends('layouts.main')
@section('content')
    <div class="container">
        <x-table>
            <x-slot name="titolo">
                <x-button class="float-right"><a href="{{ route('milestone.create', $sottoProgetto) }}"><i
                            class="lni lni-plus"></i> Aggiungi Milestone</a></x-button>
                <h2 class=" testo titolo grande">Elenco delle milestones del
                    progetto {{ $sottoProgetto->titolo}}</h2>
            </x-slot>
            <x-slot name="colonne">
                <th class="px-4 py-3 ">Descrizione</th>
                <th class="px-4 py-3 responsive">Data Evento</th>
                @if(!Auth::user()->hasRuolo("manager"))
                    <th class="px-4 py-3 ">Azioni</th>
                @endif
            </x-slot>
            <x-slot name="righe">
                {{ $milestones->links() }}
                @foreach ($milestones as $milestone)
                    <x-tr class="@if($loop->index%2==0) bg-gray @else bg-white @endif">
                        <x-slot name="body">
                            <x-td>
                                <x-slot name="body"> {{ $milestone->descrizione }}</x-slot>
                            </x-td>
                            <x-td class="responsive">
                                <x-slot name="body"> {{ date('d/m/Y', strtotime($milestone->data_evento )) }}</x-slot>
                            </x-td>
                            @if(!Auth::user()->hasRuolo("manager"))
                                <x-td>
                                    <x-slot name="body">
                                        <a href="{{ route('milestone.show', [$milestone->sotto_progetto->id,$milestone->id]) }}"><i
                                                class="lni lni-eye"></i></a>
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
                                    </x-slot>
                                </x-td>
                            @endif
                        </x-slot>
                    </x-tr>
                @endforeach
            </x-slot>
        </x-table>
    </div>

@endsection
