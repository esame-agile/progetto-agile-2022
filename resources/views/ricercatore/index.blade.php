@extends('layouts/main')
@section('content')
    @if(!count($ricercatori))
        <div id="home" class="relative z-10 header-hero pt-40">
            <div class="container mx-auto">
                <div class="justify-center row">
                    <div class="w-full lg:w-5/6 xl:w-2/3">
                        <div style='background-color:rgb(255, 255, 255)'>
                            <div class="relative px-4 mx-auto max-w-7xl sm:px-6 lg:px-4 pb-10" style="cursor: auto;">
                                <div
                                    class="max-w-lg mx-auto overflow-hidden rounded-lg shadow-lg lg:max-w-none lg:flex">
                                    <div class="flex-1 px-6 py-8 bg-white" style="cursor: auto;">
                                        <h3 class="text-2xl font-extrabold text-gray-900 sm:text-3xl"
                                            style="cursor: auto;">
                                            <span class="">Nessun <strong>ricercatore</strong> presente</span>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container top mx-auto">
            <h2 class="testo titolo grande">Elenco ricercatori</h2>
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
                                            <td class="px-4 py-3 text-ms font-semibold border">
                                                <a class="underline"
                                                   href="{{route("ricercatore.guest-show", $ricercatore)}}">{{$ricercatore->nome}}</a>
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
    @endif
@endsection
