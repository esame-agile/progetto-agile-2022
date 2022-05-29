@extends('layouts/main')
@section('content')
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold leading-normal text-blueGray-700 mb-2 uppercase">Elenco ricercatori</h2>
        <div class="card-grey mb-10">
            <div class="w-full overflow-hidden rounded-lg shadow-lg">
                <div class="w-full overflow-x-auto">
                    <table class="w-full">
                        <thead>
                        <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                            <th class="px-4 py-2">Nome</th>
                            <th class="px-4 py-2">Ambito ricerca</th>
                            <th class="px-4 py-2">Università</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                        @if($ricercatori != null)
                            {{$ricercatori->links()}}

                            @if($ricercatori->isEmpty())
                                <tr class="text-gray-700">
                                    <td class="px-4 py-2 text-left">-</td>
                                    <td class="px-4 py-2 text-left">-</td>
                                    <td class="px-4 py-2 text-left">-</td>
                                </tr>
                            @else
                                @foreach($ricercatori as $ricercatore)
                                    <tr class="text-gray-700">
                                        <td class="px-4 py-2 text-ms font-semibold border">
                                            <a class="underline"
                                               href="{{route("ricercatore.guest-show", $ricercatore)}}">{{$ricercatore->nome . ' ' . $ricercatore->cognome}}</a>
                                        </td>
                                        <td class="px-4 py-2 text-sm font-semibold border"> {{$ricercatore->ambito_ricerca}}</td>
                                        <td class="px-4 py-2 text-sm font-semibold border">{{$ricercatore->universita}}</td>
                                    </tr>
                                @endforeach
                            @endif
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
