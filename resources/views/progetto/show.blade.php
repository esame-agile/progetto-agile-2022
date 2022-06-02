@extends('layouts.main')
@section('content')
    <div class="container mx-auto">
        <div class="flex flex-wrap justify-between mb-10">
            <div class="card-grey lg:w-5/12 h-full">
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
                </div>
            </div>
            <div class="lg:w-6/12">
                <x-table>
                    <x-slot name="titolo_interno">
                        ELENCO RICERCATORI
                    </x-slot>
                    <x-slot name="pulsanti_up_interno">
                        @auth
                            @if(Auth::user()->id == $progetto->responsabile_id)
                                <x-button class="mb-10">
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
            </div>
        </div>
        <div class="flex flex-wrap justify-between">
            <div class="lg:w-5/12">
                <x-table>
                    <x-section name="pulsanti_up">
                        @auth
                            @if(Auth::user()->id == $progetto->responsabile_id)
                                <x-button>
                                    <a href="{{route('pubblicazioni.edit',$progetto)}}">
                                        VISIBILITA'
                                    </a>
                                </x-button>
                            @endif
                        @endauth
                    </x-section>
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
                        @auth
                            @if(Auth::user()->id == $progetto->responsabile_id)
                                <x-th>Visibile</x-th>
                            @endif
                        @endauth
                    </x-slot>
                    <x-slot name="righe">
                        @if(isset($pubblicazioni))
                            @if($pubblicazioni->isEmpty())
                                <x-tr>
                                    <x-td class="text-left">-</x-td>
                                    <x-td class="text-left">-</x-td>
                                    @auth
                                        @if(Auth::user()->id == $progetto->responsabile_id)
                                            <x-td class="text-left">-</x-td>
                                        @endif
                                    @endauth
                                </x-tr>
                            @else
                                @foreach($pubblicazioni as $pubblicazione)
                                    @if($pubblicazione->ufficiale || (Auth::user() != null && Auth::user()->id == $progetto->responsabile_id))
                                        <x-tr>
                                            <x-td>
                                                <a class="underline"
                                                   href="{{route("pubblicazione.show", $pubblicazione)}}">
                                                    {{$pubblicazione->titolo}}
                                                </a>
                                            </x-td>
                                            <x-td>
                                                <a class="underline"
                                                   href="{{route('pubblicazioni.download', $pubblicazione->file_name)}}">
                                                    {{$pubblicazione->file_name}}
                                                </a>
                                            </x-td>
                                            @if(Auth::user()->id == $progetto->responsabile_id)
                                                @if($pubblicazione->ufficiale)
                                                    <th class="px-4 py-3">
                                                        <i class="fa-solid fa-check"></i>
                                                    </th>
                                                @else
                                                    <th class="px-4 py-3">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </th>
                                                @endif
                                            @endif
                                        </x-tr>
                                    @endif
                                @endforeach
                            @endif
                        @endif
                    </x-slot>
                </x-table>
            </div>
            <div class="lg:w-6/12">
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
                                <x-button class="mb-10">
                                    <a href="{{route("sotto-progetto.create")}}">
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
                                    <x-td class="text-left resp640">-</x-td>
                                </x-tr>
                            @else
                                @foreach($sottoProgetti as $sottoProgetto)
                                    <x-tr>
                                        <x-td>
                                            <a class="underline"
                                               href="{{route("ricercatore.guest-show", $sottoProgetto)}}">
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
            </div>

            <!-- REPORT -->
            @auth
                <div class="mt-10 py-10 border-t border-blueGray-200 text-center w-full">
                    <div class="text-center mt-12">
                        <h3 class=" text-xl font-semibold leading-normal text-blueGray-700 mb-2">
                            Report</h3>
                    </div>
                </div>
                @if(Auth::user()!=null && Auth::user()->hasRuolo("ricercatore"))
                    <x-button class="mb-5">
                        <a href="{{route("report.create", $progetto)}}">
                            AGGIUNGI REPORT
                        </a>
                    </x-button>
                @endif
                <div class="card tabella">
                    <section class="container mx-fit p-6 font-semibold">
                        <div class="w-full overflow-hidden rounded-lg shadow-lg">
                            <div class="w-full overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                    <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                        <th class="px-4 py-3 text-center">
                                            Titolo
                                        </th>
                                        <th class="px-4 py-3 responsive text-center">
                                            File
                                        </th>
                                        <th class="px-4 py-3 responsive text-center">
                                            Data
                                        </th>
                                        <th class="px-4 py-3 responsive text-center">
                                            Ricercatore
                                        </th>
                                        <th class="px-4 py-3 responsive text-center">
                                            Azioni
                                        </th>


                                    </tr>
                                    </thead>
                                    <tbody class="bg-white">

                                    @if($reports==!null)
                                        @foreach($reports as $report)
                                            <tr class="text-gray-700">
                                                <th class="px-4 py-3">
                                                    {{$report->titolo}}
                                                </th>
                                                <th class="px-4 py-3">
                                                    <a href="{{route('report.download', $report->file_name)}}" >{{$report->file_name}}</a>

                                                </th>
                                                <th class="px-4 py-3">
                                                    {{$report->data}}
                                                </th>
                                                <th class="px-4 py-3">
                                                    {{$report->autore->nome}}
                                                </th>
                                                <x-td>
                                                    <x-slot name="body">
                                                        @if(Auth::user()!=null && Auth::user()->hasRuolo('ricercatore') && $report->ricercatore_id==Auth::user()->id)
                                                            <form method="POST"
                                                                  action="{{ route('report.destroy', ["report" => $report, "progetto" => $progetto] ) }}"
                                                                  id="delete_report"
                                                                  name="delete_report"
                                                                  onsubmit="confirm('Sei sicuro di voler cancellare?')">
                                                                @csrf
                                                                @method("DELETE")
                                                                <button type="submit"><i class="lni lni-trash"></i></button>
                                                            </form>
                                                        @else
                                                            <p>/</p>
                                                        @endif
                                                    </x-slot>
                                                </x-td>


                                            </tr>
                                        @endforeach
                                    @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>  <!-- fine container -->
                    </section>
                </div>
            @endauth


        </div>
    </div>
@endsection
