@extends("layouts.main")
@section("content")
    <div class="container mx-auto">
        @yield('alert-message')
        <h2 class="testo titolo grande">Modifica Milestone</h2>
        <div class="card">
            <div class="card-body">
                <div class="form-container">
                    <form class="informazioni" method="POST"
                          action="{{ route('milestone.update', ["sotto-progetto" => $sottoProgetto, "milestone" => $milestone]) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-6">
                            <div class="form-control float-left inline-block">
                                <label for="descrizione" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Descrizione</label>
                                <x-input name="descrizione" type="text" id="descrizione" value="{{$milestone->descrizione}}"
                                         class="@error('descrizione') is-invalid @enderror "
                                         required></x-input>
                            </div>
                            <div class="form-control float-right inline-block">
                                <label for="data_evento"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Data Evento</label>
                                <x-input type="date" id="data_evento"
                                         name="data_evento"
                                         value="{{$milestone->data_evento }}"
                                         required
                                         class="@error('data_evento') is-invalid @enderror">
                                </x-input>
                            </div>
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
