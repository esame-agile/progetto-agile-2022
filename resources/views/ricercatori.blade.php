@extends('layouts/main')
@section('content')

    <section class="container mx-auto p-6 font-mono mLR">
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
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
                    @foreach($ricercatori as $ricercatore)
                        <tr class="text-gray-700">
                            <td class="px-4 py-3 text-ms font-semibold border"><a href="{{route("pagina-personale.guest-index", $ricercatore)}}">{{$ricercatore->nome}}</a></td>
                            <td class="px-4 py-3 text-ms font-semibold border">{{$ricercatore->cognome}}</td>
                            <td class="px-4 py-3 text-sm font-semibold border"> {{$ricercatore->ambito_ricerca}}</td>
                            <td class="px-4 py-3 text-sm font-semibold border">{{$ricercatore->universita}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection
