@extends('layouts.main')
@section('content')
    <div class="container mx-auto">
        <x-table>
            <x-slot name="titolo">
                Elenco delle spese
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
                @endauth
            </x-slot>
            <x-slot name="colonne">
                <x-th>Importo</x-th>
                <x-th>Causale</x-th>
                <x-th>Data</x-th>
                @auth
                    @if(Auth::user()->id == $progetto->responsabile_id)
                        <x-th>Stato</x-th>
                        <x-th>Approva la spesa</x-th>
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
                                    <x-td>-</x-td>
                                    <x-td>-</x-td>
                                @endif
                            @endauth
                        </x-tr>
                    @endif
                    @if(Auth::user()->id == $progetto->responsabile_id)
                        @foreach ($movimenti as $movimento)
                            <x-tr>
                                <x-td>{{ $movimento->importo }}</x-td>
                                <x-td>{{$movimento->causale }}</x-td>
                                <x-td class="resp640">
                                    {{ date('d/m/Y', strtotime($movimento->data )) }}
                                </x-td>
                                <x-td>
                                    @if($movimento->approvazione==2)
                                        <i class="fa-solid fa-xmark"></i>
                                    @elseif($movimento->approvazione==1)
                                        <i class="fa-solid fa-check"></i>
                                    @elseif($movimento->approvazione==0)
                                        <i class="fa-solid fa-clock"></i>
                                    @endif
                                </x-td>
                                <x-td>
                                    @if($movimento->approvazione==0)
                                        {{--  <a class="px-5" href="">  </a>--}}
                                        <form method="POST"
                                              action="{{route('movimento.approva',compact('progetto','movimento'))}}">
                                            @csrf
                                            @method("PUT")
                                            <button type="submit"><i class="fa-solid fa-check"></i></button>
                                        </form>
                                        <form method="POST"
                                              action="{{route('movimento.disapprova',compact('progetto','movimento'))}}">
                                            @csrf
                                            @method("PUT")
                                            <button type="submit"><i class="fa-solid fa-xmark"></i></button>
                                        </form>
                                    @else
                                        -
                                    @endif
                                </x-td>
                            </x-tr>
                        @endforeach
                    @endif
                    @if(Auth::user()->id != $progetto->responsabile_id)
                        @foreach($movimenti as $movimento)
                            @if($movimento->approvazione==1)
                                <x-tr>
                                    <x-td>{{ $movimento->importo }}</x-td>
                                    <x-td>{{$movimento->causale }}</x-td>
                                    <x-td class="resp640">
                                        {{ date('d/m/Y', strtotime($movimento->data )) }}
                                    </x-td>
                                </x-tr>
                            @endif
                        @endforeach
                    @endif
                @endif
            </x-slot>
        </x-table>
    </div>
@endsection
