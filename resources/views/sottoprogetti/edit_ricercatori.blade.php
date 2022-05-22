@extends("layouts.main")
@include("layouts.alert-message")
@section("content")
    <div class="container">
        @if(!$ricercatori->isEmpty())
            <x-table>
                <x-slot name="titolo">
                    <x-button class="float-right"> <a href="{{ route('sottoprogetti.add_ricercatore', compact("sottoProgetto")) }}"><i class="lni lni-plus"></i> Aggiungi ricercatore</a></x-button>
                    <h2 class=" testo titolo grande">Elenco dei sottoprogetti</h2>
                </x-slot>
                <x-slot name="colonne">
                    <th class="px-4 py-3 ">Nome</th>
                    <th class="px-4 py-3 ">Cognome</th>
                    <th class="px-4 py-3 responsive">Email</th>
                    <th class="px-4 py-3">Ambito di ricerca</th>
                    <th class="px-4 py-3 ">Azioni</th>
                </x-slot>
                <x-slot name="righe">
                    {{ $ricercatori->links() }}
                    @foreach ($ricercatori as $ricercatore)
                        <x-tr class="@if($loop->index%2==0) bg-gray @else bg-white @endif">
                            <x-slot name="body">
                                <x-td>
                                    <x-slot name="body">
                                        {{ $ricercatore->nome }}
                                    </x-slot>
                                </x-td>
                                <x-td>
                                    <x-slot name="body"> {{ $ricercatore->cognome }}</x-slot>
                                </x-td>
                                <x-td class="responsive">
                                    <x-slot name="body" > {{ $ricercatore->email }}</x-slot>
                                </x-td>
                                <x-td>
                                    <x-slot name="body"> {{$ricercatore->ambito_ricerca}} </x-slot>
                                </x-td>
                                <x-td>
                                    <x-slot name="body">
                                        <form method="POST"
                                              action="{{ route('sottoprogetti.remove_ricercatore', ["sottoProgetto" => $sottoProgetto, "ricercatore" => $ricercatore] ) }}"
                                              id="delete_sottoProgetto"
                                              name="delete_sottoProgetto"
                                              onsubmit="onRemove()">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" data-modal-toggle="popup-modal"> <i class="lni lni-cross-circle"></i> Rimuovi</button>
                                        </form>
                                    </x-slot>

                                </x-td>
                            </x-slot>
                        </x-tr>
                    @endforeach
                </x-slot>
            </x-table>
        @else
            @yield('alert-message')
        @endif
    </div>

    <script>
        function onRemove() {
            if(!confirm("Sei sicuro di voler rimuovere il ricercatore?")){
                event.preventDefault();
            }
        }
    </script>
@endsection
