@extends("layouts.main")
@section("content")
    <div class="container mx-auto">
        @yield('alert-message')
        <h2 class="text-3xl font-bold leading-normal text-blueGray-700 mb-2 ml-5 uppercase">Modifica Milestone</h2>
        <div class="card-grey mb-10">
            <form method="POST"
                  action="{{ route('milestone.update', ["sottoProgetto" => $sottoProgetto, "milestone" => $milestone]) }}">
                @csrf
                @method('PUT')
                <div class="mb-6 flex flex-wrap justify-between">
                    <div class="w-1/2 pr-3">
                        <label for="descrizione"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Descrizione
                        </label>
                        <x-input name="descrizione" type="text" id="descrizione" value="{{$milestone->descrizione}}"
                                 class="@error('descrizione') is-invalid @enderror" required>
                        </x-input>
                    </div>
                    <div class="w-1/2 pr-3">
                        <label for="data_evento"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Data Evento
                        </label>
                        <x-input type="date" id="data_evento"
                                 name="data_evento"
                                 value="{{$milestone->data_evento }}"
                                 required
                                 class="@error('data_evento') is-invalid @enderror">
                        </x-input>
                    </div>
                </div>

                <x-button type="submit">
                    Salva modifiche
                </x-button>
            </form>
        </div>
    </div>
@endsection
