@extends('layouts.main')
@section('content')
    <div class="container mx-auto">
        <x-table>
            <x-slot name="titolo">
                Elenco delle spese per <a class="underline"
                                          href="{{route("progetto.show", compact("progetto"))}}">{{$progetto->titolo}}</a>
            </x-slot>
            <x-slot name="link">
                @if(isset($movimenti))
                    <div class="px-5 pb-5">
                        {{$movimenti->links()}}
                    </div>
                @endif
            </x-slot>
            <x-slot name="pulsanti_up">
                @auth
                    @if(Auth::user()->hasRuolo('ricercatore'))
                        <x-button>
                            <a href="{{route("movimento.create", compact("progetto"))}}">
                                RICHIEDI SPESA
                            </a>
                        </x-button>
                    @endif
                    @if(Auth::user()->hasRuolo('finanziatore'))
                        <x-button>
                            <a href="{{route("movimento.create", compact("progetto"))}}">
                                FINANZIA PROGETTO
                            </a>
                        </x-button>
                    @endif
                @endauth
            </x-slot>
            <x-slot name="titolo_interno">
                <h2 class="text-xl font-bold leading-normal text-blueGray-700 ml-5 uppercase">
                    BUDGET ATTUALE: {{$progetto->budget}}€
                </h2>
            </x-slot>
            <x-slot name="colonne">
                <x-th>Importo</x-th>
                <x-th>Causale</x-th>
                <x-th>Data</x-th>
                @auth
                    @if(Auth::user()->id == $progetto->responsabile_id)
                        <x-th class="text-center">Stato</x-th>
                        <x-th class="text-center">Approva la spesa</x-th>
                    @endif
                @endauth
            </x-slot>
            <x-slot name="righe">
                @if(isset($movimenti))
                    @if($movimenti->isEmpty())
                        <x-tr>
                            <x-td>-</x-td>
                            <x-td>-</x-td>
                            <x-td>-</x-td>
                            @auth
                                @if(Auth::user()->id == $progetto->responsabile_id)
                                    <x-td class="text-center">-</x-td>
                                    <x-td class="text-center">-</x-td>
                                @endif
                            @endauth
                        </x-tr>
                    @else
                        @auth
                            @foreach ($movimenti as $movimento)
                                <x-tr>
                                    @if($movimento->importo > 0)
                                        <x-td class="text-green-600">{{$movimento->importo}}€</x-td>
                                    @else
                                        <x-td class="text-red-600">{{$movimento->importo}}€</x-td>
                                    @endif
                                    <x-td>{{$movimento->causale }}</x-td>
                                    <x-td class="resp640">
                                        {{ date('d/m/Y', strtotime($movimento->data )) }}
                                    </x-td>
                                    @if(Auth::user()->id == $progetto->responsabile_id)
                                        <x-td>
                                            @if($movimento->approvazione==2)
                                                <i class="fa-solid fa-xmark flex justify-center"></i>
                                            @elseif($movimento->approvazione==1)
                                                <i class="fa-solid fa-check flex justify-center"></i>
                                            @elseif($movimento->approvazione==0)
                                                <i class="fa-solid fa-clock flex justify-center"></i>
                                            @endif
                                        </x-td>
                                        <x-td>
                                            @if($movimento->approvazione==0)
                                                <div class="flex flex-wrap justify-center ">
                                                    <form method="POST" class="pr-5"
                                                          action="{{route('movimento.approva',compact('progetto','movimento'))}}">
                                                        @csrf
                                                        @method("PUT")
                                                        <button type="submit"><i class="fa-solid fa-check"></i></button>
                                                    </form>
                                                    <form method="POST" class="pl-5"
                                                          action="{{route('movimento.disapprova',compact('progetto','movimento'))}}">
                                                        @csrf
                                                        @method("PUT")
                                                        <button type="submit"><i class="fa-solid fa-xmark"></i></button>
                                                    </form>
                                                </div>
                                            @else
                                                <span class="flex flex-wrap justify-center">-</span>
                                            @endif
                                        </x-td>
                                    @endif
                                </x-tr>
                            @endforeach
                        @endauth
                    @endif
                @endif
            </x-slot>
        </x-table>
    </div>
@endsection
