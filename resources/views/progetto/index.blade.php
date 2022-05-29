@extends('layouts.main')
@section('content')
    <div class="container mx-auto">
        <h2 class="text-3xl font-bold leading-normal text-blueGray-700 mb-2 uppercase">
            @if(isset($mieiProgetti))
                I MIEI PROGETTI
            @else
                ELENCO PROGETTI
            @endif
        </h2>
        <div class="card-grey mb-10">
            <div class="w-full overflow-hidden rounded-lg shadow-lg">
                <div class="w-full overflow-x-auto">
                    <table class="w-full">
                        <thead>
                        <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                            <th class="px-4 py-2">Titolo</th>
                            @auth()
                                <th class="px-4 py-2">Responsabile</th>
                            @endauth
                            <th class="px-4 py-2">Scopo</th>
                            <th class="px-4 py-2">Data inizio</th>
                            <th class="px-4 py-2">Data fine</th>
                            @auth
                                @if(Auth::user()->ruolo == 'manager')
                                    <th class="px-4 py-2">Azioni</th>
                                @endif
                            @endauth
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                        @if($progetti != null)
                            {{$progetti->links()}}
                            @if($progetti->isEmpty())
                                <tr class="text-gray-700">
                                    <td class="px-4 py-2 text-left">-</td>
                                    <td class="px-4 py-2 text-left">-</td>
                                    <td class="px-4 py-2 text-left">-</td>
                                </tr>
                            @else
                                @foreach($progetti as $progetto)
                                    <tr class="text-gray-700">
                                        <td class="px-4 py-2 text-ms font-semibold border">
                                            <a class="underline"
                                               href="{{route("progetto.show", $progetto)}}">{{$progetto->titolo}}</a>
                                        </td>
                                        @auth()
                                            @if(Auth::user()->id == $progetto->responsabile_id)
                                                <td class="px-4 py-2 text-sm font-semibold border"><i
                                                        class="lni lni-crown flex justify-center"></i></td>
                                            @else
                                                <td class="px-4 py-2 text-sm font-semibold border text-center">-
                                                </td>
                                            @endif
                                        @endauth
                                        <td class="px-4 py-2 text-ms font-semibold border">{{$progetto->scopo}}</td>
                                        <td class="px-4 py-2 text-sm font-semibold border"> {{$progetto->data_inizio}}</td>
                                        <td class="px-4 py-2 text-sm font-semibold border">{{$progetto->data_fine}}</td>
                                        @auth()
                                            @if(Auth::user()->ruolo == 'manager')
                                                <td class="px-4 py-2 text-sm font-semibold border">
                                                    <a href="{{ route('progetto.edit', $progetto) }}"><i
                                                            class="lni lni-pencil float-left"></i></a>
                                                    <form method="POST"
                                                          class="float-right"
                                                          action="{{ route('progetto.destroy', $progetto) }}"
                                                          id="delete_progetto"
                                                          name="delete_progetto"
                                                          onsubmit="confirm('Sei sicuro di voler cancellare?')">
                                                        @csrf
                                                        @method("DELETE")
                                                        <button type="submit"><i class="lni lni-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            @endif
                                        @endauth
                                    </tr>
                                @endforeach
                            @endif
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            @if(isset($mieiProgetti))
                <x-button class="mt-5">
                    <a href="{{route("sotto-progetto.index")}}">
                        I MIEI SOTTOPROGETTI
                    </a>
                </x-button>
            @else
                <x-button class="mt-5">
                    <a href="{{route("sotto-progetto.index")}}">
                        SOTTOPROGETTI
                    </a>
                </x-button>
            @endif
        </div>
    </div>

@endsection
