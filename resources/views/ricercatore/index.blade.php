@extends('layouts/main')
@section('content')
    <div class="container mx-auto">
        <x-table>
            <x-slot name="titolo">
                ELENCO RICERCATORI
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
@endsection
