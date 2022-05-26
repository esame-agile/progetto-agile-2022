@extends("layouts.main")
@include("layouts.alert-message")
@section("content")
    <div class="container mx-auto">
        @yield('alert-message')
        <h2 class="testo titolo grande">Modifica Sottoprogetto</h2>
        <div class="card">
            <div class="card-body">
                <div class="form-container">
                    <form class="informazioni" method="POST" id="informazioni"
                          action="{{ route('sottoprogetti.update', ["sottoprogetti" => $sottoprogetti]) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-6">
                            <div class="form-control float-left inline-block">
                                <label for="descrizione" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Titolo</label>
                                <x-input name="titolo" type="text" id="titolo" value="{{ $sottoprogetti->titolo}}"
                                         class="@error('titolo') is-invalid @enderror "
                                         required></x-input>
                            </div>
                            <div class="form-control float-right inline-block">
                                <label for="descrizione" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Descrizione</label>
                                <x-input name="descrizione" type="text" id="descrizione" value="{{$sottoprogetti->descrizione}}"
                                         class="@error('descrizione') is-invalid @enderror "
                                         required></x-input>
                            </div>
                            <div class="form-control float-left inline-block">
                                <label for="data_rilascio"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Data Rilascio</label>
                                <x-input type="date" id="data_rilascio"
                                         name="data_rilascio"
                                         value="{{$sottoprogetti->data_rilascio}}"
                                         required
                                         class="@error('data_rilascio') is-invalid @enderror">
                                </x-input>
                            </div>
                            <div class="form-control float-right inline-block">
                                <label for="responsabile_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Responsabile</label>
                                <x-select name="responsabile_id" id="responsabile_id" form="informazioni">
                                    <x-slot name="body">
                                        @foreach($ricercatori as $ricercatore)
                                            <option value="{{$ricercatore->id}}"
                                                    @if($ricercatore->id == $sottoprogetti->responsabile_id) selected @endif>{{$ricercatore->nome}} {{$ricercatore->cognome}}
                                            </option>
                                        @endforeach
                                    </x-slot>
                                </x-select>
                            </div>
                            <input type="hidden" name="progetto_id" value="{{$sottoprogetti->progetto_id}}">
                        </div>

                        <x-button type="submit" class="float-right">
                            Salva modifiche
                        </x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
