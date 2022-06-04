@extends('layouts.main')
@section('content')
    <div class="container mx-auto">
        <div class="row">
            <div class="lg:w-6/12 pr-5 column">
                <!-----Descrizione----->
                <div class="card-grey mb-10">
                    <div class="card-white px-5 py-5">
                        <h3 class="text-4xl font-semibold leading-normal text-blueGray-700 uppercase">
                            {{$progetto->titolo}}
                        </h3>
                    </div>
                    <div class="card-white mt-5 px-5 py-5">
                        <div class="text-sm leading-normal text-blueGray-700 font-bold uppercase">
                            SCOPO:
                        </div>
                        <div class="text-blueGray-700">
                            {{$progetto->scopo}}
                        </div>
                        <div class="text-sm leading-normal text-blueGray-700 font-bold uppercase">
                            DATA D'INIZIO:
                        </div>
                        <div class="text-blueGray-700">
                            {{$progetto->data_inizio}}
                        </div>
                        <div class="text-sm leading-normal text-blueGray-700 font-bold uppercase">
                            DATA DI FINE:
                        </div>
                        <div class="text-blueGray-700">
                            {{$progetto->data_fine}}
                        </div>
                        <div class="text-sm leading-normal text-blueGray-700 font-bold uppercase">
                            RESPONSABILE:
                        </div>
                        <div class="text-blueGray-700">
                            <a class="underline"
                               href="{{route("ricercatore.show", $progetto->responsabile)}}">
                                {{$progetto->responsabile->nome . " " . $progetto->responsabile->cognome}}
                            </a>
                        </div>
                        <div class="text-sm leading-normal text-blueGray-700 font-bold uppercase">
                            BUDGET ATTUALE:
                        </div>
                        <div class="text-blueGray-700">
                            {{$progetto->budget}}€
                            <x-button class="float-right">
                                <a href="{{route("movimento.index",$progetto)}}">
                                    VEDI MOVIMENTI
                                </a>
                            </x-button>
                        </div>

                    </div>
                </div>
                <!-----Fine Descrizione----->
                <!-----Pubblicazioni----->
                <x-table>
                    <x-slot name="titolo_interno">
                        ELENCO PUBBLICAZIONI
                    </x-slot>
                    <x-slot name="link">
                        @if(isset($pubblicazioni))
                            <div class="px-5 pb-5">
                                {{$pubblicazioni->links()}}
                            </div>
                        @endif
                    </x-slot>
                    <x-slot name="colonne">
                        <x-th>Titolo</x-th>
                        <x-th>File</x-th>
                        <x-th>Tipologia</x-th>
                        <x-th>Autori</x-th>
                        @auth
                            @if(Auth::user()->id == $progetto->responsabile_id)
                                <x-th class="text-center">Visibile</x-th>
                            @endif
                        @endauth
                    </x-slot>
                    <x-slot name="righe">
                        @if(isset($pubblicazioni))
                            @if($pubblicazioni->isEmpty())
                                <x-tr>
                                    <x-td class="text-left">-</x-td>
                                    <x-td class="text-left">-</x-td>
                                    <x-td class="text-left">-</x-td>
                                    <x-td class="text-left">-</x-td>
                                    @auth
                                        @if(Auth::user()->id == $progetto->responsabile_id)
                                            <x-td class="text-center">-</x-td>
                                        @endif
                                    @endauth
                                </x-tr>
                            @else
                                @foreach($pubblicazioni as $pubblicazione)
                                    @if($pubblicazione->ufficiale || (Auth::user() != null && Auth::user()->id == $progetto->responsabile_id))
                                        <x-tr>
                                            <x-td>{{$pubblicazione->titolo}}</x-td>
                                            <x-td>
                                                <a class="underline"
                                                   href="{{route('pubblicazioni.download', $pubblicazione->file_name)}}">
                                                    {{$pubblicazione->file_name}}
                                                </a>
                                            </x-td>
                                            <x-td>{{$pubblicazione->tipologia}}</x-td>
                                            <x-td>{{$pubblicazione->autori_esterni}}</x-td>
                                            @if(Auth::user()->id == $progetto->responsabile_id)
                                                <x-td>
                                                    @if($pubblicazione->ufficiale)
                                                        <div class="flex justify-center">
                                                            <form method="POST"
                                                                  action="{{ route('pubblicazioni.update', compact('progetto', 'pubblicazione')) }}">
                                                                @csrf
                                                                @method("PUT")
                                                                <input type="hidden" name="visibilita" value="0">
                                                                <button type="submit"><i class="fa-solid fa-check"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @else
                                                        <div class="flex justify-center">
                                                            <form method="POST"
                                                                  action="{{ route('pubblicazioni.update', compact('progetto', 'pubblicazione')) }}">
                                                                @csrf
                                                                @method("PUT")
                                                                <input type="hidden" name="visibilita" value="1">
                                                                <button type="submit"><i class="fa-solid fa-xmark"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </x-td>
                                            @endif
                                        </x-tr>
                                    @endif
                                @endforeach
                            @endif
                        @endif
                    </x-slot>
                </x-table>
                <!-----Fine Pubblicazioni----->
                <!-----Report----->
                @auth
                    <x-table>
                        <x-slot name="titolo_interno">
                            REPORT
                        </x-slot>
                        <x-slot name="link">
                            @if(isset($sottoProgetti))
                                <div class="px-5 pb-5">
                                    {{$sottoProgetti->links()}}
                                </div>
                            @endif
                        </x-slot>
                        <x-slot name="pulsanti_up_interno">
                            @if(Auth::user()->hasRuolo("ricercatore"))
                                <x-button>
                                    <a href="{{route("report.create", $progetto)}}">
                                        AGGIUNGI REPORT
                                    </a>
                                </x-button>
                            @endif
                        </x-slot>
                        <x-slot name="colonne">
                            <x-th>Titolo</x-th>
                            <x-th>File</x-th>
                            <x-th>Data</x-th>
                            <x-th>Ricercatore</x-th>
                            <x-th class="text-center">Azioni</x-th>
                        </x-slot>
                        <x-slot name="righe">
                            @if(isset($reports))
                                @if($reports->isEmpty())
                                    <x-tr>
                                        <x-td class="text-left">-</x-td>
                                        <x-td class="text-left">-</x-td>
                                        <x-td class="text-left">-</x-td>
                                        <x-td class="text-left">-</x-td>
                                        <x-td class="text-center">-</x-td>
                                    </x-tr>
                                @else
                                    @foreach($reports as $report)
                                        <x-tr>
                                            <x-td>{{$report->titolo}}</x-td>
                                            <x-td class="underline"><a
                                                    href="{{route('report.download', $report->file_name)}}">{{$report->file_name}}</a>
                                            </x-td>
                                            <x-td>{{$report->data}}</x-td>
                                            <x-td>{{$report->autore->nome}}</x-td>
                                            <x-td>
                                                <div class="flex flex-wrap justify-center">
                                                    @auth()
                                                        @if($report->ricercatore_id==Auth::user()->id)

                                                            <form method="POST"
                                                                  action="{{ route('report.destroy', ["report" => $report, "progetto" => $progetto] ) }}"
                                                                  id="delete_report"
                                                                  name="delete_report"
                                                                  onsubmit="confirm('Sei sicuro di voler cancellare?')">
                                                                @csrf
                                                                @method("DELETE")
                                                                <button type="submit"><i class="lni lni-trash"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            -
                                                        @endif
                                                    @endauth
                                                </div>
                                            </x-td>
                                        </x-tr>
                                    @endforeach
                                @endif
                            @endif
                        </x-slot>
                    </x-table>
                @endauth
                <!-----Fine Report----->
            </div>


            <div class="lg:w-6/12 pl-5 column">
                <!-----Ricercatori----->
                <x-table>
                    <x-slot name="titolo_interno">
                        ELENCO RICERCATORI
                    </x-slot>
                    <x-slot name="pulsanti_up_interno">
                        @auth
                            @if(Auth::user()->id == $progetto->responsabile_id)
                                <x-button>
                                    <a href="{{route("progetto.edit-ricercatori", compact("progetto"))}}">
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
                    <x-slot name="colonne">
                        <x-th>Nome</x-th>
                        <x-th>Ambito ricerca</x-th>
                        <x-th class="resp640">Università</x-th>
                    </x-slot>
                    <x-slot name="righe">
                        <x-tr>
                            @if(isset($ricercatori))
                                @if($ricercatori->isEmpty())
                                    <x-td class="text-left">-</x-td>
                                    <x-td class="text-left">-</x-td>
                                    <x-td class="text-left resp640">-</x-td>
                                @else
                                    @foreach($ricercatori as $ricercatore)
                                        <x-td>
                                            <a class="underline"
                                               href="{{route("ricercatore.guest-show", $ricercatore)}}">
                                                {{$ricercatore->nome . ' ' . $ricercatore->cognome}}
                                            </a>
                                        </x-td>
                                        <x-td>{{$ricercatore->ambito_ricerca}}</x-td>
                                        <x-td class="resp640">{{$ricercatore->universita}}</x-td>
                                    @endforeach
                                @endif
                            @endif
                        </x-tr>
                    </x-slot>
                </x-table>
                <!-----Fine Ricercatori----->
                <!-----Sotto Progetti----->
                <x-table>
                    <x-slot name="titolo_interno">
                        ELENCO SOTTO PROGETTI
                    </x-slot>
                    <x-slot name="link">
                        @if(isset($sottoProgetti))
                            <div class="px-5 pb-5">
                                {{$sottoProgetti->links()}}
                            </div>
                        @endif
                    </x-slot>
                    <x-slot name="pulsanti_up_interno">
                        @auth
                            @if(Auth::user()->hasRuolo("manager"))
                                <x-button>
                                    <a href="{{route("sotto-progetto.create", compact('progetto'))}}">
                                        CREA SOTTOPROGETTO
                                    </a>
                                </x-button>
                            @endif
                        @endauth
                    </x-slot>
                    <x-slot name="colonne">
                        <x-th>Titolo</x-th>
                        <x-th>Data rilascio</x-th>
                    </x-slot>
                    <x-slot name="righe">
                        @if(isset($sottoProgetti))
                            @if($sottoProgetti->isEmpty())
                                <x-tr>
                                    <x-td class="text-left">-</x-td>
                                    <x-td class="text-left">-</x-td>
                                </x-tr>
                            @else
                                @foreach($sottoProgetti as $sottoProgetto)
                                    <x-tr>
                                        <x-td>
                                            <a class="underline"
                                               href="{{route("sotto-progetto.show", $sottoProgetto)}}">
                                                {{$sottoProgetto->titolo}}
                                            </a>
                                        </x-td>
                                        <x-td>{{$sottoProgetto->data_rilascio}}</x-td>
                                    </x-tr>
                                @endforeach
                            @endif
                        @endif
                    </x-slot>
                </x-table>
                <!-----Fine Sotto Progetti----->
            </div>
        </div>
    </div>
@endsection

