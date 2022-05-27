@extends('layouts.main')
@include('layouts.alert-message')
@section('content')
    <div class="container">
        @if($sottoProgetti != null)
            <x-table>
                <x-slot name="titolo">
                    @auth
                        @if(app('request')->input('progetto') !== null)
                            @if(Auth::user()->hasRuolo('manager'))
                                <x-button class="float-right"><a href="{{ route('sotto-progetto.create') }}"><i
                                            class="lni lni-plus"></i> Aggiungi Sottoprogetto</a></x-button>
                            @endif
                            <h2 class=" testo titolo grande">Elenco dei sottoprogetti del
                                progetto {{ \App\Models\Progetto::find(app('request')->input('progetto'))->titolo }}</h2>
                        @elseif(Auth::user()->hasRuolo("manager"))
                            <x-button class="float-right"><a href="{{ route('sotto-progetto.create') }}"><i
                                        class="lni lni-plus"></i> Aggiungi Sottoprogetto</a></x-button>
                            <h2 class=" testo titolo grande">Elenco di tutti i sottoprogetti</h2>
                            {{--@elseif(Auth::user()->hasRuolo("responsabile"))
                                <h2 class=" testo titolo grande">Elenco dei sotto-progetto di cui sei responsabile</h2>--}}
                        @elseif(Auth::user()->hasRuolo("ricercatore"))
                            <h2 class=" testo titolo grande">Elenco dei sottoprogetti a cui sei assegnato</h2>
                        @endauth
                    @else
                        <h2 class=" testo titolo grande">Elenco dei sottoprogetti</h2>
                    @endif
                </x-slot>
                <x-slot name="colonne">
                    <th class="px-4 py-3 ">Titolo</th>
                    <th class="px-4 py-3 ">Descrizione</th>
                    <th class="px-4 py-3 responsive">Data Rilascio</th>
                    @auth
                        @if(Auth::user()->hasRuolo("manager") || Auth::user()->hasRuolo("ricercatore") && Auth::user()->id == $sottoProgetti[0]->progetto->responsabile_id)
                            <th class="px-4 py-3 ">Azioni</th>
                        @endif
                    @endauth
                </x-slot>
                <x-slot name="righe">
                    {{ $sottoProgetti->links() }}
                    @foreach ($sottoProgetti as $sottoProgetto)
                        <x-tr class="@if($loop->index%2==0) bg-gray @else bg-white @endif">
                            <x-slot name="body">
                                <x-td>
                                    <x-slot name="body">
                                        <a href="{{route("sotto-progetto.show", $sottoProgetto)}}">{{$sottoProgetto->titolo}}</a>
                                    </x-slot>
                                </x-td>
                                <x-td>
                                    <x-slot name="body"> {{ $sottoProgetto->descrizione }}</x-slot>
                                </x-td>
                                <x-td class="responsive">
                                    <x-slot
                                        name="body"> {{ date('d/m/Y', strtotime($sottoProgetto->data_rilascio )) }}</x-slot>
                                </x-td>
                                @auth
                                    @if(Auth::user()->hasRuolo("manager") || Auth::user()->hasRuolo("ricercatore") && Auth::user()->id == $sottoProgetti[0]->progetto->responsabile_id)
                                        <x-td>
                                            <x-slot name="body">
                                                @if(Auth::user()->hasRuolo("manager"))
                                                    <a href="{{ route('sotto-progetto.edit', ["sotto-progetto" => $sottoProgetto]) }}"><i
                                                            class="lni lni-pencil"></i></a>
                                                    <form method="POST"
                                                          action="{{ route('sotto-progetto.destroy', ["sotto-progetto" => $sottoProgetto] ) }}"
                                                          id="delete_sottoProgetto"
                                                          name="delete_sottoProgetto"
                                                          onsubmit="confirm('Sei sicuro di voler cancellare?')">
                                                        @csrf
                                                        @method("DELETE")
                                                        <button type="submit"><i class="lni lni-trash"></i></button>
                                                    </form>
                                                @elseif(Auth::user()->hasRuolo("ricercatore") && $sottoProgetto->responsabile_id == Auth::user()->id)
                                                    <a href="{{ route('sotto-progetto.edit-ricercatori', ["sottoProgetto" => $sottoProgetto]) }}">
                                                        <x-button>
                                                            <i class="lni lni-pencil"></i>
                                                            <p class="text-gray-200 ml-2"> Ricercatori </p>
                                                        </x-button>
                                                    </a>
                                                @endif
                                            </x-slot>
                                        </x-td>
                                    @endif
                                @endauth
                            </x-slot>
                        </x-tr>
                    @endforeach
                </x-slot>
            </x-table>
        @else
            <div id="home" class="relative z-10 header-hero pt-40">
                <div class="container">
                    <div class="justify-center row">
                        <div class="w-full lg:w-5/6 xl:w-2/3">
                            <div style='background-color:rgb(255, 255, 255)'>
                                <div class="relative px-4 mx-auto max-w-7xl sm:px-6 lg:px-4 pb-10"
                                     style="cursor: auto;">
                                    <div
                                        class="max-w-lg mx-auto overflow-hidden rounded-lg shadow-lg lg:max-w-none lg:flex">
                                        <div class="flex-1 px-6 py-8 bg-white" style="cursor: auto;">
                                            <h3 class="text-2xl font-extrabold text-gray-900 sm:text-3xl"
                                                style="cursor: auto;">
                                                <span class="">Nessun <strong>progetto</strong> inserito</span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection
