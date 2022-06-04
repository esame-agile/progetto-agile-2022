@extends('layouts.main')
@section('content')
    <div class="container mx-auto">
        <div class="row">
            <div class="lg:w-6/12 pr-5 column">
                <!-----Descrizione----->
                <div class="card-grey mb-10">
                    <div class="card-white px-5 py-5">
                        <h3 class="text-4xl font-semibold leading-normal text-blueGray-700 uppercase">
                            {{$sottoProgetto->titolo}}
                        </h3>
                        @auth
                            @if(Auth::user()->ruolo == "manager")
                                <div class="flex flex-wrap">
                                    <a href="{{ route('sotto-progetto.edit', $sottoProgetto) }}"><i
                                            class="lni lni-pencil px-12"></i></a>
                                    <form method="POST"
                                          action="{{ route('sotto-progetto.destroy', $sottoProgetto) }}"
                                          id="delete_progetto"
                                          name="delete_progetto"
                                          onsubmit="confirm('Sei sicuro di voler cancellare?')">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit"><i class="lni lni-trash"></i></button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                    <div class="card-white mt-5 px-5 py-5">
                        <div class="text-sm leading-normal text-blueGray-700 font-bold uppercase">
                            DESCRIZIONE:
                        </div>
                        <div class="text-blueGray-700">
                            {{$sottoProgetto->descrizione}}
                        </div>
                        <div class="text-sm leading-normal text-blueGray-700 font-bold uppercase">
                            DATA DI RILASCIO PREVISTA:
                        </div>
                        <div class="text-blueGray-700">
                            {{$sottoProgetto->data_rilascio}}
                        </div>
                        <div class="text-sm leading-normal text-blueGray-700 font-bold uppercase">
                            RESPONSABILE:
                        </div>
                        <div class="text-blueGray-700">
                            <a class="underline"
                               href="{{route("ricercatore.show", $sottoProgetto->responsabile)}}">
                            {{$sottoProgetto->responsabile->nome . " " . $sottoProgetto->responsabile->cognome}}
                            </a>
                        </div>
                        <div class="text-sm leading-normal text-blueGray-700 font-bold uppercase">
                            PROGETTO ASSOCIATO:
                        </div>
                        <div class="text-blueGray-700">
                            <a class="underline"
                               href="{{route("progetto.show", $progetto)}}">
                                {{$progetto->titolo}}
                            </a>
                        </div>
                    </div>
                </div>
                <!-----Fine Descrizione----->
                <!-----Milestones----->
                <x-table>
                    <x-slot name="titolo_interno">
                        ELENCO MILESTONES
                    </x-slot>
                    <x-slot name="pulsanti_up_interno">
                        @auth
                            @if(Auth::user()->id == $sottoProgetto->responsabile_id)
                                <x-button>
                                    <a href="{{route("milestone.create", compact("sottoProgetto"))}}">
                                        CREA MILESTONE
                                    </a>
                                </x-button>
                            @endif
                        @endauth
                    </x-slot>
                    <x-slot name="link">
                        @if(isset($milestones))
                            <div class="px-5 pb-5">
                                {{$milestones->links()}}
                            </div>
                        @endif
                    </x-slot>
                    <x-slot name="colonne">
                        <x-th>Data di rilascio</x-th>
                        <x-th>Descrizione</x-th>
                        @auth
                            @if(Auth::user()->id == $sottoProgetto->responsabile_id)
                                <x-th class="text-left">Azioni</x-th>
                            @endif
                        @endauth
                    </x-slot>
                    <x-slot name="righe">
                        @if(isset($milestones))
                            @if($milestones->isEmpty())
                                <x-tr>
                                    <x-td class="text-left">-</x-td>
                                    <x-td class="text-left">-</x-td>
                                    @auth
                                        @if(Auth::user()->id == $sottoProgetto->responsabile_id)
                                            <x-td class="text-left">-</x-td>
                                        @endif
                                    @endauth
                                </x-tr>
                            @else
                                @foreach($milestones as $milestone)
                                    <x-tr>
                                        <x-td>{{$milestone->data_evento}}</x-td>
                                        <x-td>{{$milestone->descrizione}}</x-td>
                                        @auth
                                            @if(Auth::user()->id == $sottoProgetto->responsabile_id)
                                                <x-td>
                                                    <div class="flex-wrap flex justify-between">
                                                        <a href="{{ route('milestone.edit', compact('sottoProgetto', 'milestone')) }}"><i
                                                                class="lni lni-pencil"></i></a>
                                                        <form method="POST"
                                                              action="{{ route('milestone.destroy', compact('sottoProgetto', 'milestone')) }}"
                                                              id="delete_milestone"
                                                              name="delete_milestone"
                                                              onsubmit="confirm('Sei sicuro di voler cancellare?')">
                                                            @csrf
                                                            @method("DELETE")
                                                            <button type="submit"><i class="lni lni-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </x-td>
                                            @endif
                                        @endauth
                                    </x-tr>
                                @endforeach
                            @endif
                        @endif
                    </x-slot>
                </x-table>
                <!-----Fine Milestones----->
            </div>

            <div class="lg:w-6/12 pl-5 column">
                <!-----Ricercatori----->
                <x-table>
                    <x-slot name="titolo_interno">
                        ELENCO RICERCATORI
                    </x-slot>
                    <x-slot name="pulsanti_up_interno">
                        @auth
                            @if(Auth::user()->id == $sottoProgetto->responsabile_id)
                                <x-button>
                                    <a href="{{route("sotto-progetto.edit-ricercatori", compact("sottoProgetto"))}}">
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
                    <x-slot name="pulsanti_up_interno">
                        @auth
                            @if(Auth::user()->id == $sottoProgetto->responsabile_id)
                                <x-button>
                                    <a href="{{route("sotto-progetto.edit-ricercatori", compact("sottoProgetto"))}}">
                                        MODIFICA RICERCATORI
                                    </a>
                                </x-button>
                            @endif
                        @endauth
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
                <!-----Fine Ricercatori----->
            </div>
        </div>
    </div>
@endsection
