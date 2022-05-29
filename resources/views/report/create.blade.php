@extends("layouts.main")
@section("content")
    <div class="container mx-auto">
        <form class="informazioni" method="POST" id="informazioni" enctype="multipart/form-data"
              action="{{ route('report.store', $progetto) }}">
            <h2 class="testo titolo grande">Nuovo report</h2>
            <div class="card">
                <div class="card-body">
                    <div class="form-container">
                        @csrf
                        <div class="mb-6">
                            <div class="form-control float-left inline-block">
                                <label for="descrizione" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Titolo</label>
                                <x-input name="titolo" type="text" id="titolo" value="{{ old('titolo') }}"
                                         required></x-input>
                            </div>
                            <div class="form-control float-right inline-block">
                                <label for="descrizione" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">File</label>
                                <x-input name="file_name" type="file" id="file_name"

                                         required></x-input>
                            </div>
                            <div class="form-control float-left inline-block">
                                <label for="data_rilascio"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Data Rilascio</label>
                                <x-input type="date" id="data_rilascio"
                                         name="data_rilascio"
                                         value="{{ old('data_rilascio') }}"
                                         required
                                         class="@error('data_rilascio') is-invalid @enderror">
                                </x-input>
                            </div>
                            <div class="form-control float-right inline-block">
                                <label for="progetto_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Progetto associato:</label>
                                <label for="progetto_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$progetto->titolo}}</label>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-button type="submit" >
                Aggiungi Report
            </x-button>
        </form>
    </div>
@endsection
