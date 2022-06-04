@extends("layouts.main")
@section("content")
    <div class="container mx-auto">
        <x-table>
            <x-slot name="titolo">
                Elenco dei ricercatori associati
            </x-slot>
            <x-slot name="link">
                <div class="px-5 pb-5">
                    {{$ricercatori->links()}}
                </div>
            </x-slot>
            <x-slot name="colonne">
                <x-th>Nome</x-th>
                <x-th>Cognome</x-th>
                <x-th>Email</x-th>
                <x-th>Ambito di ricerca</x-th>
                <x-th>Azioni</x-th>
            </x-slot>
            <x-slot name="righe">
                @if(isset($ricercatori))
                    @if($ricercatori->isEmpty())
                        <x-tr>
                            <x-td>-</x-td>
                            <x-td class="resp640">-</x-td>
                            <x-td class="resp640">-</x-td>
                            <x-td class="resp640">-</x-td>
                            <x-td class="resp640">-</x-td>
                            @auth
                                @if(Auth::user()->ruolo == 'manager' || Auth::user()->ruolo == 'ricercatore')
                                    <x-td class="text-center">-</x-td>
                                @endif
                            @endauth
                        </x-tr>
                    @else
                        @foreach ($ricercatori as $ricercatore)
                            <x-tr class="@if($loop->index%2==0) bg-gray @else bg-white @endif">
                                <x-td class="underline"><a href="{{route("ricercatore.guest-show", $ricercatore)}}">
                                    {{ $ricercatore->nome }}
                                </x-td>
                                <x-td>{{ $ricercatore->cognome }}</x-td>
                                <x-td>{{ $ricercatore->email }}</x-td>
                                <x-td>{{$ricercatore->ambito_ricerca}}</x-td>
                                <x-td>
                                    <form method="POST"
                                          action="{{ route('progetto.remove-ricercatore', compact('progetto', 'ricercatore')) }}"
                                          id="delete_progetto"
                                          name="delete_progetto"
                                          onsubmit="onRemove()">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" data-modal-toggle="popup-modal"><i
                                                class="lni lni-cross-circle"></i> Rimuovi
                                        </button>
                                    </form>
                                </x-td>
                            </x-tr>
                        @endforeach
                    @endif
                @endif
            </x-slot>
            <x-slot name="pulsanti">
                <div class="px-5 pt-5">
                    <form method="POST"
                          action="{{ route('progetto.store-ricercatore', compact("progetto")) }}">
                        @csrf
                        @method("POST")
                        <ul class="scroll-py-1 text-sm text-gray-700 dark:text-gray-200 max-h-48 overflow-y-scroll columns-3">
                            @foreach($ricercatori_add as $ricercatore)
                                <li class="inline-block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                    <div class="block w-48">
                                    <label>
                                        <input type="checkbox" name="ricercatori[]"
                                               tabindex="-1"
                                               value="{{$ricercatore->id}}">
                                        {{$ricercatore->nome}} {{$ricercatore->cognome}}
                                    </label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <x-button class="mt-5" type="submit" ><i class="lni lni-plus"></i> Aggiungi ricercatori</x-button>
                    </form>
                </div>
            </x-slot>
        </x-table>
    </div>

    <script>
        function onRemove() {
            if (!confirm("Sei sicuro di voler rimuovere il ricercatore?")) {
                event.preventDefault();
            }
        }
    </script>
@endsection
