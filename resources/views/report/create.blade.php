@extends('layouts/main')
@section('content')
    <div class="container mx-auto">
        @yield('alert-message')
        <h2 class="text-3xl font-bold leading-normal text-blueGray-700 mb-2 ml-5 uppercase">CREA REPORT</h2>
        <div class="card-grey mb-10">
            <form method="POST" enctype="multipart/form-data"
                  action="{{ route('report.store', compact('progetto')) }}">
                @csrf
                <x-label>Progetto: {{$progetto->titolo}}</x-label>
                <div class="mb-6 flex flex-wrap justify-between">
                    <div class="w-1/3 pr-3">
                        <label for="titolo"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Titolo
                        </label>
                        <x-input name="titolo" type="text" id="titolo" value="{{ old('titolo') }}"
                                 required></x-input>
                    </div>
                    <div class="w-1/3">
                        <label for="data_rilascio"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                            Data di rilascio
                        </label>
                        <x-input name="data_rilascio" type="date" id="data_rilascio" value="{{ old('data_rilascio') }}"
                                 required></x-input>
                    </div>
                    <div class="w-1/3 pl-3">
                        <x-label for="file_name">File</x-label>
                        <input name="file_name" type="file" id="file_name" value="{{ old('file_name') }}"
                               class="h-11"
                               required>
                    </div>
                </div>
                <x-button type="submit">
                    Crea nuovo report
                </x-button>
            </form>
        </div>
    </div>
@endsection

