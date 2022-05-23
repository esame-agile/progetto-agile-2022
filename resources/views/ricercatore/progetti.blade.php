@extends('layouts/main')
@section('content')
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

                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            @if($progetti != null)
                                @foreach($progetti as $progetto)
                                    <tr class="text-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-4 py-3 text-ms font-semibold border"> <a
                                                href="{{route("progetto_info", $progetto)}}">{{$progetto->titolo}}</a>

                                        </td>
                                        <td class="px-4 py-3 text-ms font-semibold border">{{$progetto->scopo}}</td>
                                        <td class="px-4 py-3 text-sm font-semibold border"> {{$progetto->data_inizio}}</td>
                                        <td class="px-4 py-3 text-sm font-semibold border">{{$progetto->data_fine}}</td>


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
