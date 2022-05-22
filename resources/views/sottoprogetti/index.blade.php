@extends('layouts.main')
@include('layouts.alert-message')
@section('content')
    <div class="container">
        @if(!$sottoProgetti->isEmpty())
            <x-table>
                <x-slot name="titolo">
                    @if(Auth::user()->hasRuolo("manager"))
                        <x-button class="float-right"> <a href="{{ route('sottoprogetti.create') }}"><i class="lni lni-plus"></i> Aggiungi Sottoprogetto</a></x-button>
                        <h2 class=" testo titolo grande">Elenco dei sottoprogetti</h2>
                    @else
                        <h2 class=" testo titolo grande">Elenco dei sottoprogetti di cui sei responsabile</h2>
                    @endif
                </x-slot>
                <x-slot name="colonne">
                    <th class="px-4 py-3 ">Titolo</th>
                    <th class="px-4 py-3 ">Descrizione</th>
                    <th class="px-4 py-3 responsive">Data Rilascio</th>
                    <th class="px-4 py-3 ">Azioni</th>
                </x-slot>
                <x-slot name="righe">
                    {{ $sottoProgetti->links() }}
                    @foreach ($sottoProgetti as $sottoProgetto)
                        <x-tr class="@if($loop->index%2==0) bg-gray @else bg-white @endif">
                            <x-slot name="body">
                                <x-td>
                                    <x-slot name="body">
                                        {{ $sottoProgetto->titolo }}
                                    </x-slot>
                                </x-td>
                                <x-td>
                                    <x-slot name="body"> {{ $sottoProgetto->descrizione }}</x-slot>
                                </x-td>
                                <x-td class="responsive">
                                    <x-slot name="body" > {{ date('d/m/Y', strtotime($sottoProgetto->data_rilascio )) }}</x-slot>
                                </x-td>
                                <x-td>
                                    <x-slot name="body">
                                        @if(Auth::user()->hasRuolo("manager"))
                                            <a href="{{ route('sottoprogetti.show', ["sottoprogetti" => $sottoProgetto]) }}"><i class="lni lni-eye"></i></a>
                                            <a href="{{ route('sottoprogetti.edit', ["sottoprogetti" => $sottoProgetto]) }}"><i class="lni lni-pencil"></i></a>
                                            <form method="POST"
                                                  action="{{ route('sottoprogetti.destroy', ["sottoprogetti" => $sottoProgetto] ) }}"
                                                  id="delete_sottoProgetto"
                                                  name="delete_sottoProgetto"
                                                  onsubmit="confirm('Sei sicuro di voler cancellare?')">
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit" ><i class="lni lni-trash"></i></button>
                                            </form>
                                        @else
                                            <a href="{{ route('sottoprogetti.edit_ricercatori', ["sottoProgetto" => $sottoProgetto]) }}">
                                                <x-button>
                                                    <i class="lni lni-pencil"></i>
                                                    <p class="text-gray-200 ml-2"> Ricercatori </p>
                                                </x-button>
                                            </a>
                                        @endif
                                    </x-slot>

                                </x-td>
                            </x-slot>
                        </x-tr>
                    @endforeach
                </x-slot>
            </x-table>
        @else
            @yield('alert-message')
        @endif
    </div>

@endsection
