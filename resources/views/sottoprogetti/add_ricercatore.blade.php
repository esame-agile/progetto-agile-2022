@extends("layouts.main")
@include("layouts.alert-message")
@section("content")
    <div class="container mx-auto">
        @yield('alert-message')
        <h2 class="testo titolo grande">Aggiungi un ricercatore al progetto</h2>
        <form class="informazioni" method="POST" id="informazioni"
              action="{{ route('sottoprogetti.add_ricercatore', compact("sottoProgetto")) }}">
            <div class="card">
                <div class="card-body">
                    <div class="form-container">
                        @csrf
                        <div class="form-control inline-block">
                            <label for="ricercatore_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ricercatore</label>
                            <x-select name="ricercatore_id" id="ricercatore_id" form="informazioni">
                                <x-slot name="body">
                                    @foreach($ricercatori as $ricercatore)
                                        <option value="{{$ricercatore->id}}">
                                                {{$ricercatore->nome}} {{$ricercatore->cognome}}
                                        </option>
                                    @endforeach
                                </x-slot>
                            </x-select>
                        </div>
                        <input type="hidden" name="progetto_id" value="{{$sottoProgetto->progetto_id}}">
                    </div>
                </div>
            </div>
            <x-button type="submit" class="float-right">
                Aggiungi ricercatore
            </x-button>
        </form>
    </div>
@endsection
