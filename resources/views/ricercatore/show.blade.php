@extends('layouts.main')
@include('layouts.alert-message')
@section('content')
    <div class="container mx-auto">
        <!--- Copertina del profilo --->
        <div class="card top copertina-profilo">
            @yield('alert-message')
            <div class="card-body">
                <div class="profile-background">
                    <!--- Immagine di copertina del profilo --->
                </div>
                <div class="profile-picture">
                    <!--- Immagine del profilo --->
                </div>
                <div class="nome-utente-container">
                    <p class="testo grande">{{$ricercatore->nome}} {{$ricercatore->cognome}} </p>

                    <p class="testo">
                        {{$ricercatore->ambito_ricerca}}
                        <br>
                        {{$ricercatore->universita}}
                    </p>

                </div>
                <div class="contatti">
                    <p class="testo">
                        {{$ricercatore->email}}
                    </p>
                </div>
            </div>
            @auth()
                {{-- Pulsante per editare informazioni personali --}}
                <a href="{{route('ricercatore.edit', $ricercatore)}}"><i
                        class="lni lni-pencil edit"></i></a>
            @endauth
            <div class="contatti hidden">
                <p class="testo">
                    {{$ricercatore->email}}
                </p>
            </div>
        </div>
        <!--- Fine copertina del profilo --->

        <!--  <h2 class="testo titolo grande">Elenco pubblicazioni</h2>
         Pubblicazioni
        <div class="card tabella">
            <section class="container mx-auto p-6 font-mono">
                <div class="w-full overflow-hidden rounded-lg shadow-lg">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full">
                            <thead>
                            <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                <th class="px-4 py-3">
                                    Pubblicazione
                                </th>
                                <th class="px-4 py-3 responsive">
                                    Nome attributo
                                </th>
                                <th class="px-4 py-3 responsive">
                                    Nome attributo
                                </th>
                                <th class="px-4 py-3 responsive">
                                    Nome attributo
                                </th>
                                <th class="px-4 py-3 text-center">
                                    Edita
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            <tr class="text-gray-700">
                                {{--@foreach($pubblicazioni as $pubblicazione)
                                    <th class="px-4 py-3">
                                        Pubblicazione {{$pubblicazione->titolo}}
                                    </th>
                                    <th class="px-4 py-3">
                                        Pubblicazione {{$pubblicazione->titolo}}
                                    </th>
                                    <td class="px-4 py-3 text-ms font-semibold border">
                                        <a href="#"><i class="lni lni-pencil float-left"></i></a>
                                        <a href="#"><i class="lni lni-trash float-right"></i></a>
                                    </td>
                                @endforeach--}}
        <td class="px-4 py-3 text-ms font-semibold border">
            Apple MacBook Pro 17"
        </td>
        <td class="px-4 py-3 text-ms font-semibold border responsive">
            Sliver
        </td>
        <td class="px-4 py-3 text-ms font-semibold border responsive">
            Laptop
        </td>
        <td class="px-4 py-3 text-ms font-semibold border responsive">
            $2999
        </td>
        <td class="px-4 py-3 text-ms font-semibold border">
            <a href="#"><i class="lni lni-pencil float-left"></i></a>
            <a href="#"><i class="lni lni-trash float-right"></i></a>
        </td>
    </tr>
    </tbody>
</table>
</div>
</div>   fine container
</section>
</div>
Fine pubblicazioni --->
        @if(!count($progetti))
            <div id="home" class="relative z-10 header-hero pt-10">
                <div class="container mx-auto">
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
                                                <span class="">Nessun <strong>progetto</strong> associato</span>
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
            <h2 class="testo titolo grande">Elenco progetti</h2>
            <!--- Progetti --->
            <div class="card tabella">
                <section class="container mx-auto p-6 font-mono">
                    <div class="w-full overflow-hidden rounded-lg shadow-lg">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                    <th class="px-4 py-3 text-center">
                                        Titolo
                                    </th>
                                    <th class="px-4 py-3 responsive text-center">
                                        Scopo
                                    </th>
                                    <th class="px-4 py-3 responsive text-center">
                                        Data di inizio
                                    </th>
                                    <th class="px-4 py-3 responsive text-center">
                                        Data di fine
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="bg-white">

                                @if($progetti != null)
                                    @foreach($progetti as $progetto)
                                        <tr class="text-gray-700">
                                            <th class="px-4 py-3 text-ms font-semibold border">
                                                <a href="{{route("progetto.show", $progetto)}}">{{$progetto->titolo}}</a>

                                            </th>
                                            <th class="px-4 py-3 text-ms font-semibold border responsive">
                                                {{$progetto->scopo}}
                                            </th>
                                            <th class="px-4 py-3 text-ms font-semibold border responsive">
                                                {{$progetto->data_inizio}}
                                            </th>
                                            <th class="px-4 py-3 text-ms font-semibold border responsive">
                                                {{$progetto->data_fine}}
                                            </th>
                                        </tr>
                                    @endforeach
                                @endif

                                </tbody>
                            </table>
                        </div>
                    </div>  <!-- fine container -->
                </section>
            </div>
        @endif
    </div>
@endsection
