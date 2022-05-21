@extends('layouts/main')
@section('content')
    <div class="container mx-auto">
        <h2 class="testo titolo grande mLR">Elenco ricercatori</h2>
        <div class="card tabella">
            <section class="container mx-auto p-6 font-mono ">
                <div class="w-full overflow-hidden rounded-lg shadow-lg">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full">
                            <thead>
                            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3">Nome</th>
                                <th class="px-4 py-3">Cognome</th>
                                <th class="px-4 py-3">Ambito ricerca</th>
                                <th class="px-4 py-3">Università</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            @if($ricercatori != null)
                                @foreach($ricercatori as $ricercatore)
                                    <tr class="text-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-4 py-3 text-ms font-semibold border"><a
                                                href="{{route("pagina-personale.ricercatore.guest-index", $ricercatore)}}">{{$ricercatore->nome}}</a>
                                        </td>
                                        <td class="px-4 py-3 text-ms font-semibold border">{{$ricercatore->cognome}}</td>
                                        <td class="px-4 py-3 text-sm font-semibold border"> {{$ricercatore->ambito_ricerca}}</td>
                                        <td class="px-4 py-3 text-sm font-semibold border">{{$ricercatore->universita}}</td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection
