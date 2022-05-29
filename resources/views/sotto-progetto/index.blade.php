@extends('layouts.main')
@include('layouts.alert-message')
@section('content')
    <div class="container mx-auto">
        @auth
            @if(Auth::user()->hasRuolo('manager'))
                <x-button class="float-right"><a href="{{ route('sotto-progetto.create') }}"><i
                            class="lni lni-plus"></i>Aggiungi sotto progetto</a></x-button>
                @if(app('request')->input('progetto') !== null)
                    <h2 class=" text-3xl font-bold leading-normal text-blueGray-700 mb-2 uppercase">
                        Elenco dei sotto progetti del progetto
                        {{ \App\Models\Progetto::find(app('request')->input('progetto'))->titolo }}</h2>
                @else
                    <h2 class=" text-3xl font-bold leading-normal text-blueGray-700 mb-2 uppercase">
                        Elenco di tutti i sotto progetti</h2>
                @endif
            @elseif(isset($mieiProgetti))
                <h2 class=" text-3xl font-bold leading-normal text-blueGray-700 mb-2 uppercase">Elenco dei sottoprogetti
                    a cui sei assegnato</h2>
            @else
                <h2 class=" text-3xl font-bold leading-normal text-blueGray-700 mb-2 uppercase">Elenco dei
                    sottoprogetti</h2>
            @endif
        @else
            <h2 class=" text-3xl font-bold leading-normal text-blueGray-700 mb-2 uppercase">Elenco dei
                sottoprogetti</h2>
        @endif

        <div class="card-grey mb-10">
            <div class="w-full overflow-hidden rounded-lg shadow-lg">
                <div class="w-full overflow-x-auto">
                    <table class="w-full">
                        <thead>
                        <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                            <th class="px-4 py-2">Titolo</th>
                            <th class="px-4 py-2">Descrizione</th>
                            <th class="px-4 py-2">Data Rilascio</th>
                            @auth
                                @if(Auth::user()->hasRuolo("manager") || Auth::user()->hasRuolo("ricercatore"))
                                    <th class="px-4 py-3 ">Azioni</th>
                                @endif
                            @endauth
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                        @if($sottoProgetti != null)
                            {{ $sottoProgetti->links() }}

                            @if($sottoProgetti->isEmpty())
                                <tr class="text-gray-700">
                                    <td class="px-4 py-2 text-left">-</td>
                                    <td class="px-4 py-2 text-left">-</td>
                                    <td class="px-4 py-2 text-left">-</td>
                                    @if(Auth::user()->hasRuolo("manager") || Auth::user()->hasRuolo("ricercatore"))
                                        <td class="px-4 py-2 text-left">-</td>
                                    @endif
                                </tr>
                            @else
                                @foreach ($sottoProgetti as $sottoProgetto)
                                    <tr class="text-gray-700">
                                        <td class="px-4 py-2 text-ms font-semibold border">
                                            <a class="underline"
                                               href="{{route("sotto-progetto.show", $sottoProgetto)}}">{{$sottoProgetto->titolo}}</a>
                                        </td>
                                        <td class="px-4 py-2 text-sm font-semibold border"> {{ $sottoProgetto->descrizione }}</td>
                                        <td class="px-4 py-2 text-sm font-semibold border"> {{ date('d/m/Y', strtotime($sottoProgetto->data_rilascio )) }}</td>
                                        @auth
                                            @if(Auth::user()->hasRuolo("manager"))
                                                <a href="{{ route('sotto-progetto.edit', compact('sottoProgetto')) }}"><i
                                                        class="lni lni-pencil"></i></a>
                                                <form method="POST"
                                                      action="{{ route('sotto-progetto.destroy', compact('sottoProgetto') ) }}"
                                                      id="delete_sottoProgetto"
                                                      name="delete_sottoProgetto"
                                                      onsubmit="confirm('Sei sicuro di voler cancellare?')">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="submit"><i class="lni lni-trash"></i>
                                                    </button>
                                                </form>
                                            @elseif(Auth::user()->hasRuolo("ricercatore") && $sottoProgetto->responsabile_id == Auth::user()->id)
                                                <a href="{{ route('sotto-progetto.edit-ricercatori', compact('sottoProgetto')) }}">
                                                    <x-button>
                                                        <i class="lni lni-pencil"></i>
                                                        <p class="text-gray-200 ml-2"> Ricercatori </p>
                                                    </x-button>
                                                </a>
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
        </div>
    </div>
@endsection
