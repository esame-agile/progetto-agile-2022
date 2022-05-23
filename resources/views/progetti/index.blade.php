@extends('layouts.main')
@section('content')

    @if(!count($progetti))
        <div id="home" class="relative z-10 header-hero pt-40">
            <div class="container">
                <div class="justify-center row">
                    <div class="w-full lg:w-5/6 xl:w-2/3">
                        <div style='background-color:rgb(255, 255, 255)'>
                            <div class="relative px-4 mx-auto max-w-7xl sm:px-6 lg:px-4 pb-10" style="cursor: auto;">
                                <div
                                    class="max-w-lg mx-auto overflow-hidden rounded-lg shadow-lg lg:max-w-none lg:flex">
                                    <div class="flex-1 px-6 py-8 bg-white" style="cursor: auto;">
                                        <h3 class="text-2xl font-extrabold text-gray-900 sm:text-3xl"
                                            style="cursor: auto;">
                                            <span class="">Nessun <strong>progetto</strong> inserito</span>
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

        <script src="https://kit.fontawesome.com/bf2b874371.js" crossorigin="anonymous"></script>
        <div class="container mx-auto">
            <h2 class="testo titolo grande mLR">Elenco progetti</h2>
            <div class="card tabella">
                <section class="container mx-auto p-6 font-mono ">
                    <div class="w-full overflow-hidden rounded-lg shadow-lg">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                    <th class="px-4 py-3">Titolo</th>
                                    <th class="px-4 py-3">Scopo</th>
                                    <th class="px-4 py-3">Data inizio</th>
                                    <th class="px-4 py-3">Data fine</th>
                                    @auth
                                    @if(Auth::user()->ruolo == 'manager')
                                        <th class="px-4 py-3">Azioni</th>
                                    @endif
                                    @endauth


                                </tr>
                                </thead>
                                <tbody class="bg-white">
                                @if($progetti != null)
                                    @foreach($progetti as $progetto)
                                        <tr class="text-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                            <td class="px-4 py-3 text-ms font-semibold border"><a
                                                    href="{{route("progetti.show", $progetto)}}">{{$progetto->titolo}}</a>

                                            </td>
                                            <td class="px-4 py-3 text-ms font-semibold border">{{$progetto->scopo}}</td>
                                            <td class="px-4 py-3 text-sm font-semibold border"> {{$progetto->data_inizio}}</td>
                                            <td class="px-4 py-3 text-sm font-semibold border">{{$progetto->data_fine}}</td>

                                            @auth
                                            @if(Auth::user()->ruolo == 'manager')
                                                <td class="px-4 py-3 text-sm font-semibold border">
                                                    <a href="{{ route('progetti.edit', ["progetti" => $progetto]) }}"><i
                                                            class="lni lni-pencil"></i></a>
                                                    <form method="POST"
                                                          action="{{ route('progetti.destroy', ["progetti" => $progetto] ) }}"
                                                          id="delete_progetto"
                                                          name="delete_progetto"
                                                          onsubmit="confirm('Sei sicuro di voler cancellare?')">
                                                        @csrf
                                                        @method("DELETE")
                                                        <button type="submit"><i class="lni lni-trash"></i></button>
                                                    </form>
                                                </td>
                                            @endif
                                            @endauth

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
