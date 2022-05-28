@extends("layouts.main")
@include("layouts.alert-message")
@section("content")
    <div class="container">
        @if(!$ricercatori->isEmpty())
            <x-table>
                <x-slot name="titolo">
                    <x-button class="float-right"> <a href="{{ route('progetto.add-ricercatore', compact("progetto")) }}"><i class="lni lni-plus"></i> Aggiungi ricercatore</a></x-button>
                    <h2 class=" testo titolo grande">Elenco dei progetti</h2>
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
                                              action="{{ route('progetto.remove-ricercatore', ["progetto" => $progetto, "ricercatore" => $ricercatore] ) }}"
                                              id="delete_progetto"
                                              name="delete_progetto"
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
                                                <span class="">Nessun <strong>ricercatore</strong> assegnato</span>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
